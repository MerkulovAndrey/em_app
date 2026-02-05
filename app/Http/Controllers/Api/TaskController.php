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
        try {
            $data = Task::where('id', '=', $id)->get();
            if (count($data) < 1) {
                throw new \Exception(sprintf("Задача с id:%d не существует", $id));
            }
        } catch (\Exception $e) {
            $this->message = "Ошибка получения задачи";
            $this->error = $e->getMessage();
            $this->status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $this->response($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [];

        try {
            $task = Task::find($id);

            // Валидация входящих данных
            $validated = $request->validate(Task::rules());

            $task = Task::findOrFail($id);

            if (!$task->update($validated)) {
                throw new \Exception("Задача не обновлена");
            } else {
                $this->status = Response::HTTP_OK; // 200
            }
        } catch (\Exception $e) {
            $this->message = "Ошибка обновления задачи";
            $this->error = $e->getMessage();
            $this->status = Response::HTTP_INTERNAL_SERVER_ERROR; // 500
        }

        return $this->response($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Task::destroy($id);
            if ($data === 0) {
                throw new \Exception(sprintf("Задача с id:%d не существует", $id));
            }
        } catch (\Exception $e) {
            $this->message = "Ошибка удаления задачи";
            $this->error = $e->getMessage();
            $this->status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $this->response($data);
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
