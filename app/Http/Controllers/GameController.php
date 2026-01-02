<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameResult;
use App\Services\GameService;
use App\Http\Requests\PlayGameRequest;

class GameController extends Controller
{
    public function __construct(
        private GameService $gameService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session()->put('balance', session('balance', 100));
        $gameResults  = GameResult::latest()->paginate(10);
        return view('games.index', compact('gameResults'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        session()->put('balance', session('balance', 100));
        
        if ($this->gameService->isLowBalance(session('balance'))) {
            return redirect()
                ->route('games.index')
                ->with('error', 'Your balance is below ₹10. Please reset your balance by clicking the reset button along side with reset icon.')
                ->with('game_over', true);
        }


        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlayGameRequest $request)
    {
        $balance = session('balance', 100);

        $betAmount = GameService::BET_AMOUNT;

        if ($balance < $betAmount)
        {
            return redirect()
                    ->route('games.create')
                    ->with('error','Balance too low to continue')
                    ->withInput();    
        }

        // deduct balance by 10
        $balance -= $betAmount;

        // rolling the dice and process the game
        $diceData = $this->gameService->rollDice();

        // getting the winning result
        $winAmount = $this->gameService->calculateWin(
            $request->bet,
            $diceData['sum']
        );

        // adjusting the balance
        $balance += $winAmount;

        // storing the remaining balance in session to display
        session()->put('balance', $balance);

        // Saving game data in history
        GameResult::create([
            'dice1' => $diceData['dice1'],
            'dice2' => $diceData['dice2'],
            'sum' => $diceData['sum'],
            'bet' => $request->bet,
            'result' => $winAmount > 0,
            'win_amount' => $winAmount,
            'balance' => $balance,
        ]);

        // putting result to session to avoid re-execute the query on page-refresh
        session()->flash('result', [
            ...$diceData,
            'result' => $winAmount > 0,
            'balance' => $balance,
        ]);

        return redirect()->route('games.result');
    }

    public function result()
    {
        if (!session()->has('result')) {
            return redirect()->route('games.index');
        }
        return view('games.result', session('result'));
    }

    public function exit()
    {
        session()->forget([
            'balance',
            'result',
        ]);

        return redirect('/')
            ->with('success', 'You have exited the game successfully.');
    }

    public function resetBalance()
    {
        session()->put('balance', 100);
        session()->forget('result');

        return redirect()->route('games.play')
            ->with('success', 'Game restarted with ₹100 balance.');
    }

}
