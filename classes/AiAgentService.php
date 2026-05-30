<?php

declare(strict_types=1);

namespace services;

/**
 * Сервис маршрутизации пользовательских запросов в систему LLM.
 *
 * Выполняет:
 * - классификацию входного сообщения (books / info / fallback)
 * - выбор сценария обработки запроса
 * - передачу контекста в AI-модель
 * - возврат сформированного ответа пользователю
 *
 * Использует локальный каталог книг и справочные данные как единственный источник контекста для модели.
 */
class AiAgentService
{
    private object $CHAT_SERVICE;
    private string $USER_MESSAGE;

    /**
     * @var array<int, array<string, mixed>>
     */
    private array $BOOKS;

    /**
     * Инициализация сервиса и загрузка каталога книг.
     *
     * @param object $chatService Клиент LLM сервиса с методом sendMessage(array $messages)
     * @param string $userMessage Текст запроса пользователя
     */
    public function __construct(object $chatService, string $userMessage)
    {
        $this->CHAT_SERVICE = $chatService;
        $this->USER_MESSAGE = $userMessage;

        $this->BOOKS = [
            [
                "ID" => 1,
                "NAME" => "Моя первая книга",
                "DESCRIPTION" => "Вводный учебный материал для начинающих школьников. Формирует базовые навыки чтения и понимания текста.",
                "URL" => "/files/Книига Сканирование.pdf",
                "CLASS" => 1
            ],
            [
                "ID" => 2,
                "NAME" => "Эпоха рисования форм",
                "DESCRIPTION" => "Практическое пособие по развитию навыков рисования, восприятия формы и построения простых художественных объектов.",
                "URL" => "/files/Эпоха рисования форм.pdf",
                "CLASS" => 1
            ],
            [
                "ID" => 3,
                "NAME" => "Математика 1 класс. Тренировочные задания для учащихся",
                "DESCRIPTION" => "Сборник упражнений для закрепления базовых математических знаний: счёт, логика, простые задачи и примеры.",
                "URL" => "/files/Математика_1_класс_тренировочные_задания_с_нумерацией.pdf",
                "CLASS" => 1
            ],
            [
                "ID" => 4,
                "NAME" => "В помощь классному учителю 1 класса. Обучение грамоте",
                "DESCRIPTION" => "Методическое пособие для учителей начальных классов. Содержит материалы для обучения грамоте и развития речи.",
                "URL" => "/files/Обучение грамоте.pdf",
                "CLASS" => 1
            ],
            [
                "ID" => 5,
                "NAME" => "Геометрия в символах",
                "DESCRIPTION" => "Продвинутый материал по геометрии с визуальными представлениями фигур и абстрактных математических объектов.",
                "URL" => "/files/Геометрия в символах.pdf",
                "CLASS" => 7
            ]
        ];
    }

    /**
     * Основная точка входа обработки запроса.
     *
     * Последовательность:
     * - классификация запроса через LLM
     * - выбор сценария обработки
     * - возврат результата соответствующего обработчика
     *
     * @return mixed Ответ LLM или fallback-структура
     */
    public function handle(): mixed
    {
        $INTENT = $this->detectIntent();

        if ($INTENT === 'books') {
            return $this->handleBooks();
        }

        if ($INTENT === 'info') {
            return $this->handleInfo();
        }

        return $this->handleFallback();
    }

    /**
     * Определение типа пользовательского запроса.
     *
     * Возвращает строго одно значение:
     * - books
     * - info
     * - fallback
     *
     * @return string
     */
    private function detectIntent(): string
    {
        $MESSAGES = [
            [
                'role' => 'system',
                'content' =>
                    'Ты классификатор запросов пользователя для сайта с книгами.' .
                    'Всегда отвечай строго одним словом без объяснений: books, info, fallback.' .
                    'КЛАСС books: если пользователь ищет, выбирает, хочет или просит книгу, обучение, материал.' .
                    'КЛАСС info: если пользователь спрашивает контакты, телефон, email, адрес, как связаться, поддержка, сайт, информация о сервисе.' .
                    'КЛАСС fallback: если запрос не относится к сайту или неясен.'
            ],
            [
                'role' => 'user',
                'content' => $this->USER_MESSAGE
            ]
        ];

        $RESPONSE = $this->CHAT_SERVICE->sendMessage($MESSAGES);

        $INTENT = strtolower(trim($RESPONSE['choices'][0]['message']['content'] ?? 'fallback'));

        if (!in_array($INTENT, ['books', 'info', 'fallback'], true)) {
            return 'fallback';
        }

        return $INTENT;
    }

    /**
     * Обработка запроса подбора книг.
     *
     * Использует полный каталог книг как контекст для модели.
     * Результат формируется в HTML (div + список ссылок).
     *
     * @return mixed Ответ LLM
     */
    private function handleBooks()
    {
        $BOOKS = $this->getAllBooks();

        $MESSAGES = [
            [
                'role' => 'system',
                'content' =>
                    'Ты AI-агент подбора книг. ' .
                    'Используй ТОЛЬКО список книг. ' .
                    'CLASS определяет уровень обучения. ' .
                    'Подбирай книги по смыслу запроса пользователя. ' .
                    'Ответ формируй в HTML. Оберни в div. Список оформляй через ul/li, ссылки через a. ' .
                    'Если подходящих книг нет — сообщи об этом.'
            ],
            [
                'role' => 'system',
                'content' =>
                    'Список книг: ' . json_encode($BOOKS, JSON_UNESCAPED_UNICODE)
            ],
            [
                'role' => 'user',
                'content' => $this->USER_MESSAGE
            ]
        ];

        return $this->CHAT_SERVICE->sendMessage($MESSAGES);
    }

    /**
     * Обработка информационных запросов.
     *
     * Использует ограниченный набор данных о сервисе (контакты, адрес).
     *
     * @return mixed Ответ LLM
     */
    private function handleInfo()
    {
        $INFO = $this->getSiteInfo();

        $MESSAGES = [
            [
                'role' => 'system',
                'content' =>
                    'Ты AI-агент сайта. Используй только предоставленные данные.'
            ],
            [
                'role' => 'system',
                'content' =>
                    'Данные: ' . json_encode($INFO, JSON_UNESCAPED_UNICODE)
            ],
            [
                'role' => 'user',
                'content' => $this->USER_MESSAGE
            ]
        ];

        return $this->CHAT_SERVICE->sendMessage($MESSAGES);
    }

    /**
     * Обработка неопределённых запросов.
     *
     * Возвращает пустой ответ-структуру.
     *
     * @return array<string, string>
     */
    private function handleFallback(): array
    {
        return [
            "answer" => ""
        ];
    }

    /**
     * Получение полного списка книг.
     *
     * @return array<int, array<string, mixed>>
     */
    private function getAllBooks(): array
    {
        return $this->BOOKS;
    }

    /**
     * Поиск книги по идентификатору.
     *
     * @param int $ID
     * @return array<string, mixed>|null
     */
    private function getBookById(int $ID): ?array
    {
        foreach ($this->BOOKS as $BOOK) {
            if ((int)$BOOK['ID'] === $ID) {
                return $BOOK;
            }
        }

        return null;
    }

    /**
     * Справочная информация о сервисе.
     *
     * @return array<string, mixed>
     */
    private function getSiteInfo(): array
    {
        return [
            "PHONE" => $this->getPhone(),
            "EMAIL" => "info@site.ru",
            "ADDRESS" => "Москва"
        ];
    }

    /**
     * Контактный номер телефона.
     *
     * @return string
     */
    private function getPhone(): string
    {
        return "+7 999 111 22 33";
    }
}