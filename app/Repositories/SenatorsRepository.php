<?php

namespace App\Repositories;

use ChileanCongress;

class SenatorsRepository
{
    public function getJournalById($id)
    {
        $journal = ChileanCongress::session()->number($id)->getSessionJournal()->fetch();

        dd($journal);
    }

    public function getSessionsActualLegislature()
    {
        $actualLegislature = ChileanCongress::legislature()->setDelegates()->getActualLegislature()->fetch();
        $actualLegislatureNumber = $actualLegislature['Numero'];

        $sessions = ChileanCongress::session()->number($actualLegislatureNumber)->getSessions()->fetch();

        return $sessions;
    }
}
