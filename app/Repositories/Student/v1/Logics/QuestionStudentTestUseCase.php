<?php

namespace App\Repositories\Student\v1\Logics;


use Illuminate\Http\Request;

abstract class QuestionStudentTestUseCase
{
    public static function getListQuestion()
    {
        return (new static)->HandleGetListQuestion();
    }

    abstract public function handleGetListQuestion();

    public static function getQuestionStudent(Request $request)
    {
        return (new static)->handleGetQuestionStudent($request);
    }

    abstract public function handleGetQuestionStudent($request);

    public static function checkAnswerStudent(Request $request)
    {
        return (new static)->handleCheckAnswerStudent($request);
    }

    abstract public function handleCheckAnswerStudent($request);

}