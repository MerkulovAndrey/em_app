<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Task;

class TaskController extends Controller
{
    private $message = '';
    private $error = '';
    private $status = Response::HTTP_OK;

    public function index()
    {
        $data = [];
        try {
            $data = Task::where('id', '>', 0)
                ->orderBy('id', 'desc')
                ->limit(1000)
                ->get();

            if (count($data) < 1) {
                throw new \Exception("Задач нет");
            }
        } catch (\Exception $e) {
            $this->message = "Ошибка получения списка задач";
            $this->error = $e->getMessage();
            $this->status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $this->response($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [];

        try {
            // Валидация входящих данных
            $validated = $request->validate(Task::rules());

            // Создание записи
            $data = Task::create($validated);

            if (!isset($data->id)) {
                throw new \Exception("Задача не создана");
            } else {
                $this->status = Response::HTTP_CREATED; // 201
            }
        } catch (\Exception $e) {
            $this->message = "Ошибка сохранения задачи";
            $this->error = $e->getMessage();
            $this->status = Response::HTTP_INTERNAL_SERVER_ERROR; // 500
        }

        return $this->response($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Сборка ответа
     * @param mixed $data - данные для подстановки в ответ
     */
    private function response(mixed $data=[])
    {
        return response()->json([
            "message" => $this->message,
            "error" => $this->error,
            "data" => $data,
        ], $this->status);
    }
}
