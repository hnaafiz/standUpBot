<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTelegramUserRequest;
use App\Http\Requests\UpdateTelegramUserRequest;
use App\Models\TelegramUser;

class TelegramUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTelegramUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TelegramUser $telegramUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TelegramUser $telegramUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTelegramUserRequest $request, TelegramUser $telegramUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TelegramUser $telegramUser)
    {
        //
    }
}
