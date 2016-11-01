<?php

namespace App\Repositories;

use ChileanCongress;

class SenatorsRepository
{
    public function getJournalById($id)
    {
        $journal = ChileanCongress::session()->number($id)->getSessionJournal()->fetch();

        dd($this->extractOrdersOfDayOfSession($journal));
    }

    public function getSessionsActualLegislature()
    {
        $actualLegislature = ChileanCongress::legislature()->setDelegates()->getActualLegislature()->fetch();
        $actualLegislatureNumber = $actualLegislature['Numero'];

        $sessions = ChileanCongress::session()->number($actualLegislatureNumber)->getSessions()->fetch();

        return $sessions;
    }

    protected function extractOrdersOfDayOfSession($session)
    {
        $projectsIds = [];

        if (isset($session['OrdenDeldia']['Proyecto'])) {
            foreach ($session['OrdenDeldia']['Proyecto'] as $project) {
                if (isset($project['@attributes'])) {
                    array_push($projectsIds, substr($project['@attributes']['Boletin'], 0, -4));
                }
            }
        }

        return $projectsIds;
    }
}
