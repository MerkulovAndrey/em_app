<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Задача: Разработка простого API для управления задачами
Требуется реализовать REST API для управления списком задач (To-Do List) на PHP с
использованием Laravel.
Требования к реализации:
1.​ Создать Laravel-проект (если нет опыта с Laravel, можно на чистом PHP).
2.​ Реализовать API с CRUD-операциями для задач:
○​ Создание задачи: POST /tasks (поля: title, description, status).
○​ Просмотр списка задач: GET /tasks (возвращает все задачи).
○​ Просмотр одной задачи: GET /tasks/{id}.
○​ Обновление задачи: PUT /tasks/{id}.
○​ Удаление задачи: DELETE /tasks/{id}.
3.​ Валидация данных (например, title не должен быть пустым).
4.​ Использовать SQLite или MySQL в качестве базы данных.
