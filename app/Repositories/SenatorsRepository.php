<?php

namespace App\Repositories;

use ChileanCongress;

class SenatorsRepository
{
    protected $cache;

    public function __construct()
    {
        $this->cache = app('cache');
    }

    public function getJournalById($id)
    {
        $key = 'journal-'.$id;
        $journal = $this->cache->get($key);

        if ($journal == null) {
            $journal = ChileanCongress::session()->number($id)->getSessionJournal()->fetch();

            $this->cache->put($key, $journal, 60 * 24);
        }

        return $journal;
    }

    public function getVotationById($id)
    {
        $key = 'votation-'.$id;
        $votation = $this->cache->get($key);

        if ($votation == null) {
            $votation = ChileanCongress::votation()->number($id)->getSenatorsVotation()->fetch();

            $this->cache->put($key, $votation, 60 * 24);
        }

        return $votation;
    }

    public function getActualSessionsOfLegislature()
    {
        $legislatureNumber = $this->getActualLegislature();

        $key = 'actual-sessions-legislature-'.$legislatureNumber;
        $sessions = $this->cache->get($key);

        if ($sessions == null) {
            $sessions = ChileanCongress::session()->number($legislatureNumber)->getSessions()->fetch();

            $this->cache->put($key, $sessions, 60 * 24);
        }

        return $sessions;
    }

    public function getActualLegislature()
    {
        $key = 'actual-legislature';
        $actualLegislature = $this->cache->get($key);

        if ($actualLegislature == null) {
            $actualLegislature = ChileanCongress::legislature()->setDelegates()->getActualLegislature()->fetch();

            $this->cache->put($key, $actualLegislature, 60 * 24);
        }

        return $this->extractActualLegislatureNumber($actualLegislature);
    }

    public function getVotationsOfSessionById($id)
    {
        $journal = $this->getJournalById($id);
        $votationsIds = $this->extractOrdersOfDayOfSession($journal);
        $votationsData = [];

        foreach ($votationsIds as $votationId) {
            $votation = $this->getVotationById($votationId);
            $votationsData[$votationId] = $votation;
        }

        return $votationsData;
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

    protected function extractActualLegislatureNumber($actualLegislature)
    {
        return $actualLegislature['Numero'];
    }
}
