<?php

namespace App\Support\TopWordsAlgorithm;

/**
 * minHeap = {'pointer', 'size', 'arr': [minHeapNode, ...]}
 * minHeapNode = {'word': word, 'trieRef': trieRef}
 * trie = {}
 * trieNode = {'count': int, 'headIdx': int, 'isEnd': false, 'children': {trieNode, ...}}
 * Credits for algorithm: http://www.geeksforgeeks.org/find-the-k-most-frequent-words-from-a-file/.
 */
class TopKWordsStat
{
    private $minHeapNode = array('word' => null, 'trieRef' => null);
    private $trieNode = array('count' => 0, 'heapIdx' => -1, 'isEnd' => false, 'children' => array());

    public function __construct($top_k)
    {
        $this->topK = $top_k;

        $this->minHeap = array('idx' => 0, 'size' => $this->topK, 'arr' => array());
        $this->trie = array();
        for ($i = 0; $i < $top_k; ++$i) {
            // init array
            $this->minHeap['arr'][$i] = null;
        }
    }

    private function wordToCode($word)
    {
        // word(include unicode word) will be transformed into a unique ascii char sequence
        $word = strtolower($word);

        return $word;
    }

    private function swapHeapNode($idx1, $idx2)
    {
        if ($idx1 === $idx2) {
            return;
        }

        $nodes = &$this->minHeap['arr'];
        $tmp = $nodes[$idx1];
        $nodes[$idx1] = $nodes[$idx2];
        $nodes[$idx2] = $tmp;
    }

    private function minHeapify($idx)
    {
        $left = $idx * 2 + 1;
        $right = $idx * 2 + 2;
        $min_idx = $idx;

        $heapNodes = &$this->minHeap['arr'];

        if ($left < $this->minHeap['idx'] &&
            $heapNodes[$left]['trieRef']['count'] < $heapNodes[$min_idx]['trieRef']['count']) {
            $min_idx = $left;
        }

        if ($right < $this->minHeap['idx'] &&
            $heapNodes[$right]['trieRef']['count'] < $heapNodes[$min_idx]['trieRef']['count']) {
            $min_idx = $right;
        }

        if ($min_idx !== $idx) {
            // update trieRef->heapIdx
            $heapNodes[$idx]['trieRef']['heapIdx'] = $min_idx;
            $heapNodes[$min_idx]['trieRef']['heapIdx'] = $idx;

            // switch value
            $this->swapHeapNode($idx, $min_idx);

            $this->minHeapify($min_idx);
        }
    }

    private function rebuildHeap()
    {
        $n = $this->minHeap['idx'] - 1;
        // be careful!
        // ($n - 1) / 2 returns a float type!!!
        // I was cruelly fucked by this issue!!!
        $i = intval(($n - 1) / 2);
        while ($i >= 0) {
            $this->minHeapify($i);
            $i -= 1;
        }
    }

    private function insertIntoMinHeap($word, &$trie)
    {
        // 1. word exists
        if ($trie['heapIdx'] > -1) {
            $this->minHeapify($trie['heapIdx']);
        }
        // 2. word no eixsts, heap not full, going to insert
        elseif ($this->minHeap['idx'] < $this->minHeap['size']) {
            $pt = $this->minHeap['idx'];
            // 1. update headIdx in trieNode
            $trie['heapIdx'] = $pt;
            // 2. update heapNode
            $node = $this->minHeapNode;
            $node['word'] = $word;
            $node['trieRef'] = &$trie;
            $this->minHeap['arr'][$pt] = &$node;

            $this->minHeap['idx'] += 1;
            $this->rebuildHeap();
        }
        // 3. word no exists, heap is full, word frequency larger than min of minHeap
        elseif ($trie['count'] > $this->minHeap['arr'][0]['trieRef']['count']) {
            $pt = 0;
            // 1. update heapIdx in trieNode which is going to be removed
            $this->minHeap['arr'][$pt]['trieRef']['heapIdx'] = -1;
            // 2. update heapIdx in trieNode which is going to be inserted
            $trie['heapIdx'] = $pt;
            // 2. update heapNode
            $node = $this->minHeapNode;
            $node['word'] = $word;
            $node['trieRef'] = &$trie;
            $this->minHeap['arr'][$pt] = &$node;

            $this->minHeapify($pt);
        }
    }

    public function insertAWord($word)
    {
        $wordCode = $this->wordToCode($word);

        $trie = &$this->trie;
        for ($i = 0; $i < (strlen($wordCode) - 1); ++$i) {
            $char = $wordCode[$i];
            if (!isset($trie[$char])) {
                $trie[$char] = $this->trieNode;
            }
            $trie = &$trie[$char]['children'];
        }

        // last character
        $char = $wordCode[strlen($wordCode) - 1];
        if (!isset($trie[$char])) {
            $trie[$char] = $this->trieNode;
        }
        $trie = &$trie[$char];

        if ($trie['isEnd']) {
            $trie['count'] += 1;
        } else {
            $trie['isEnd'] = true;
            $trie['count'] = 1;
        }
        $this->insertIntoMinHeap($word, $trie);
    }

    public function getTopKWords()
    {
        for ($i = 0; $i < $this->topK; ++$i) {
            $backIdx = $this->topK - 1 - $i;
            $this->swapHeapNode(0, $backIdx);

            $this->minHeap['idx'] -= 1;
            $this->rebuildHeap();
        }

        $arr = array();
        for ($j = 0; $j < $this->topK; ++$j) {
            $node = &$this->minHeap['arr'][$j];
            $arr[$j] = array('word' => $node['word'], 'count' => $node['trieRef']['count']);
        }

        return $arr;
    }
}
