<?php
$rows = [
  ['user'=>'  Ali  ', 'starts_at'=>'2025-12-20 10:00', 'duration'=>'90m',  'tz'=>'UTC'],
  ['user'=>'vali',    'starts_at'=>'20/12/2025 12:00', 'duration'=>'1h',   'tz'=>'UTC'],
  ['user'=>'ALI',     'starts_at'=>'2025/12/21 09:30', 'duration'=>'45m',  'tz'=>'UTC'],
  ['user'=>'Bob',     'starts_at'=>'invalid',          'duration'=>'30m',  'tz'=>'UTC'],
];

$formats = ['Y-m-d H:i', 'd/m/Y H:i', 'Y/m/d H:i'];
$schedules = [];
$byUser = [];
$byDay =[];
foreach ($rows as $row) {
    $normUser = strtolower(trim($row['user']));
    $validDt = null;
    foreach($formats as $frm){
        $dt = DateTimeImmutable::createFromFormat($frm, $row['starts_at']);
        $errors = DateTimeImmutable::getLastErrors();
        if ($dt && ($errors['error_count'] ?? 0 ) === 0 && ($errors['warning_count']?? 0) === 0){
            $validDt = $dt;
            break;
        }
    }
    if ($validDt ===null){
        continue;
    }
    $minDuration = $row['duration'];
    if(substr($minDuration, -1) === 'm'){
        $drtn =  (int)$minDuration;
    }else{
        $drtn =  (int)$minDuration * 60;
    }

    $endsAt = $validDt->add(new DateInterval('PT'.$drtn.'M'));

    $schedules[]=
        [
            'user' => $normUser,
            'starts_at' => $validDt->format('Y-m-d H:i'),
            'minutes' => $drtn,
            'ends_at' => $endsAt->format('Y-m-d H:i'),
    ];
    if(!isset($byUser[$normUser])){
        $byUser[$normUser] = 0;
    }
    $byUser[$normUser] += $drtn;

    $dayKey = $validDt->format('Y-m-d');
    if(!isset($byDay[$dayKey])){
        $byDay[$dayKey] = 0;
    }
    $byDay[$dayKey] += $drtn; 
}

foreach ($schedules as $schedule => &$s) $s['__i'] = $schedule;
unset($s);

usort($schedules, function($a, $b){
    $c = $b['starts_at'] <=> $a['starts_at'];
    if($c !== 0) return $c;

    return $a['__i'] <=> $b['__i'];
});

foreach ($schedules as &$s) unset($s['__i']);
unset($s);


ksort($byUser);
ksort($byDay);


$final = [
    'by_user' => $byUser,
    'by_day' => $byDay,
    'schedule' => $schedules,
    
];

print_r($final);