<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class BowlingScoreCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Game State
    public $frames = []; // [1 => ['1' => '', '2' => '', '3' => '', 'status' => '', 'result' => '']]
    public $currentFrame = 1;
    public $currentThrow = 1;
    public $gameOver = false;
    public $totalScore = 0;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->resetGame();
    }

    public function resetGame()
    {
        $this->frames = array_fill(1, 10, [
            '1' => '', 
            '2' => '', 
            '3' => '', 
            'status' => '', 
            'result' => ''
        ]);
        $this->currentFrame = 1;
        $this->currentThrow = 1;
        $this->gameOver = false;
        $this->totalScore = 0;
        $this->error = null;
    }

    public function handleInput($op)
    {
        if ($this->gameOver) return;

        if ($op === 'X') {
            $this->handleStrike();
        } elseif ($op === '/') {
            $this->handleSpare();
        } else {
            $this->handleNumber((int)$op);
        }

        $this->calculateScores();
    }

    private function handleNumber($pins)
    {
        $frame = &$this->frames[$this->currentFrame];

        if ($this->currentFrame < 10) {
            if ($this->currentThrow == 1) {
                $frame['1'] = $pins;
                $this->currentThrow = 2;
            } else {
                $frame['2'] = $pins;
                $frame['status'] = 'no';
                $this->moveToNextFrame();
            }
        } else {
            // Frame 10
            if ($this->currentThrow == 1) {
                $frame['1'] = $pins;
                $this->currentThrow = 2;
            } elseif ($this->currentThrow == 2) {
                $frame['2'] = $pins;
                if ($frame['1'] + $frame['2'] < 10) {
                    $this->endGame();
                } else {
                    $this->currentThrow = 3;
                }
            } else {
                $frame['3'] = $pins;
                $this->endGame();
            }
        }
    }

    private function handleStrike()
    {
        $frame = &$this->frames[$this->currentFrame];

        if ($this->currentFrame < 10) {
            $frame['1'] = 10;
            $frame['2'] = '';
            $frame['status'] = 'X';
            $this->moveToNextFrame();
        } else {
            // Frame 10
            if ($this->currentThrow == 1) {
                $frame['1'] = 10;
                $this->currentThrow = 2;
            } elseif ($this->currentThrow == 2) {
                $frame['2'] = 10;
                $this->currentThrow = 3;
            } else {
                $frame['3'] = 10;
                $this->endGame();
            }
        }
    }

    private function handleSpare()
    {
        $frame = &$this->frames[$this->currentFrame];

        if ($this->currentFrame < 10) {
            $frame['2'] = 10 - (int)$frame['1'];
            $frame['status'] = '/';
            $this->moveToNextFrame();
        } else {
            // Frame 10
            if ($this->currentThrow == 2) {
                $frame['2'] = 10 - (int)$frame['1'];
                $this->currentThrow = 3;
            } elseif ($this->currentThrow == 3) {
                // If throw 2 was X, then throw 3 can be / of whatever pins were there? 
                // Actually JS logic: results[frame_no][throw_no] = parseInt(10 - parseInt(results[frame_no][throw_no-1]));
                $frame['3'] = 10 - (int)$frame['2'];
                $this->endGame();
            }
        }
    }

    private function moveToNextFrame()
    {
        $this->currentFrame++;
        $this->currentThrow = 1;
    }

    private function endGame()
    {
        $this->gameOver = true;
    }

    private function calculateScores()
    {
        $cumulative = 0;
        for ($i = 1; $i <= 10; $i++) {
            $frame = &$this->frames[$i];
            $frameScore = $this->getFrameScore($i);
            
            if ($frameScore !== null) {
                $cumulative += $frameScore;
                $frame['result'] = $cumulative;
                $this->totalScore = $cumulative;
            } else {
                $frame['result'] = '';
            }
        }
    }

    private function getFrameScore($frameIdx)
    {
        $frame = $this->frames[$frameIdx];

        if ($frameIdx < 10) {
            if ($frame['status'] === 'X') {
                $next = $this->getNextTwoThrows($frameIdx);
                return ($next !== null) ? (10 + $next) : null;
            } elseif ($frame['status'] === '/') {
                $next = $this->getNextThrow($frameIdx);
                return ($next !== null) ? (10 + $next) : null;
            } else {
                if ($frame['1'] !== '' && $frame['2'] !== '') {
                    return (int)$frame['1'] + (int)$frame['2'];
                }
            }
        } else {
            // Frame 10
            if ($frame['1'] !== '' && $frame['2'] !== '') {
                if ($frame['1'] + $frame['2'] < 10) {
                    return (int)$frame['1'] + (int)$frame['2'];
                } elseif ($frame['3'] !== '') {
                    return (int)$frame['1'] + (int)$frame['2'] + (int)$frame['3'];
                }
            }
        }
        return null;
    }

    private function getNextThrow($frameIdx)
    {
        $nextFrame = $this->frames[$frameIdx + 1] ?? null;
        if (!$nextFrame) return null;
        if ($nextFrame['1'] !== '') return (int)$nextFrame['1'];
        return null;
    }

    private function getNextTwoThrows($frameIdx)
    {
        $nextFrame = $this->frames[$frameIdx + 1] ?? null;
        if (!$nextFrame) return null;

        if ($frameIdx + 1 < 10) {
            if ($nextFrame['status'] === 'X') {
                $secondNext = $this->frames[$frameIdx + 2] ?? null;
                if ($secondNext && $secondNext['1'] !== '') {
                    return 10 + (int)$secondNext['1'];
                }
            } else {
                if ($nextFrame['1'] !== '' && $nextFrame['2'] !== '') {
                    return (int)$nextFrame['1'] + (int)$nextFrame['2'];
                }
            }
        } else {
            // Next is frame 10
            if ($nextFrame['1'] !== '' && $nextFrame['2'] !== '') {
                return (int)$nextFrame['1'] + (int)$nextFrame['2'];
            }
        }
        return null;
    }

    public function render()
    {
        return view('livewire.calculators.bowling-score-calculator');
    }
}
