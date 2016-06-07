<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
return array(
    'MATCH' => array(
        'required' => array('region', 'sum_name', 'win', 'match_type', 'champion_name'),
        'txt' => " {region}'s summoner:{sum_name} {win} {match_type}  With {champion_name}"
    ),
     'RANK' => array(
        'required' => array('region', 'sum_name', 'last_rank', 'downorup','new_rank'),
        'txt' => "{region}'s summoner:{sum_name} Ranked {downorup}  From {last_rank} To {new_rank}"
    ),
    'IN_GAME' => array(
        'required' => array('region', 'sum_name', 'match_type', 'champion_name'),
        'txt' => " {region}'s summoner:{sum_name}  IS currently IN {match_type}  With {champion_name}"
    )
);
