<?php 
function thousandsCurrencyFormat($num) {
    if($num>1000 || $num<0) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array(' Rb', ' Jt', ' Mil', ' Tril');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? ',' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];
        return $x_display;
    }
    return $num;
}
function formatuang($jenis, $angka,$symbol){
    if ($jenis == "IDR"){
        $hasil = $symbol." ". number_format($angka,2,',','.');
    }
	return $hasil;
}
function slugify($text, string $divider = '-')
{
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, $divider);
    $text = preg_replace('~-+~', $divider, $text);
    $text = strtolower($text);
    if (empty($text)) {
        return 'Text tidak diketehui';
    }
    return $text;
}

function leakLisensi($kondisi){
    return false;
}
function escapeHtml($string){
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
function replaceEvenCharactersWithAsterisk($inputString) {
    $words = explode(' ', $inputString);
    $replacedWords = array_map(function ($word) {
      $replacedWord = '';
      for ($i = 0; $i < strlen($word); $i++) {
        if ($i % 2 === 1) {
          $replacedWord .= '*';
        } else {
          $replacedWord .= $word[$i];
        }
      }
      return $replacedWord;
    }, $words);
    return implode(' ', $replacedWords);
  }
  function getStringBeforeNumber($string) {
    $pattern = '/^(.*?)(\d*)$/';
    preg_match($pattern, $string, $matches);
    return $matches[1];
}
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $randomString;
}
function generateSelectTreeView($informasidata, $idselect2, $level = 0) {
    $select = '';
    if ($level === 0) {
        $select .= '<select class="form-control" id="'.$idselect2.'">';
        $select .= '<option value="">Silahkan pilih COA Induk</option>';
    }
    foreach ($informasidata as $item) {
        $indentation = str_repeat('&nbsp;', $level * 5);
        if ($item['JENISAKUN'] == "GRUP"){
            if ($item['PARENT_ID'] == "0") {
                $select .= '<option style="color:red" value="' . $item['ID'] . '">' . $indentation . $item['KODE_COA_GROUP'] . ' - ' . $item['NAMA_COA_GROUP'] . ' ('.$item['DEFAULTINPUT'].')</option>';
            } else if ($item['JENISAKUN'] == "LEDGER") {
                $select .= '<option value="' . $item['ID'] . '">' . $indentation . $item['KODE_COA_GROUP'] . ' - ' . $item['NAMA_COA_GROUP'] . ' ('.$item['DEFAULTINPUT'].')</option>';
            } else {
                $select .= '<option style="color:black" value="' . $item['ID'] . '">' . $indentation . $item['KODE_COA_GROUP'] . ' - ' . $item['NAMA_COA_GROUP'] . ' ('.$item['DEFAULTINPUT'].')</option>';
            }
            if (isset($item['children']) && !empty($item['children'])) {
                $select .= generateSelectTreeView($item['children'], $idselect2, $level + 1);
            }
        }
    }
    if ($level === 0) {
        $select .= '</select>';
    }
    return $select;
}
function generateSelectTreeViewledger($informasidata, $idnya, $hanyapilihleder = null, $level = 0) {
    $select = '';
    if ($level === 0) {
        $select .= '<select class="form-control" id="'.$idnya.'">';
        $select .= '<option value="">Silahkan pilih COA Ledger</option>';
    }
    foreach ($informasidata as $item) {
        $indentation = str_repeat('&nbsp;', $level * 5);
        if ($hanyapilihleder == 1){
            if ($item['PARENT_ID'] == "0" || $item['JENISAKUN'] == "GRUP") {
                $select .= '<option '.($hanyapilihleder == 1 ? "disabled" : "" ).' style="color:red" value="' . $item['ID'] . '">' . $indentation . $item['KODE_COA_GROUP'] . ' - ' . $item['NAMA_COA_GROUP'] . ' ('.$item['DEFAULTINPUT'].')</option>';
            } else if ($item['JENISAKUN'] == "LEDGER") {
                $select .= '<option value="' . $item['ID'] . '">' . $indentation . $item['KODE_COA_GROUP'] . ' - ' . $item['NAMA_COA_GROUP'] . ' ('.$item['DEFAULTINPUT'].')</option>';
            } else {
                $select .= '<option style="color:black" value="' . $item['ID'] . '">' . $indentation . $item['KODE_COA_GROUP'] . ' - ' . $item['NAMA_COA_GROUP'] . ' ('.$item['DEFAULTINPUT'].')</option>';
            }
        }else{
            if ($item['JENISAKUN'] == "GRUP"){
                if ($item['PARENT_ID'] == "0") {
                    $select .= '<option style="color:red" value="' . $item['ID'] . '">' . $indentation . $item['KODE_COA_GROUP'] . ' - ' . $item['NAMA_COA_GROUP'] . ' ('.$item['DEFAULTINPUT'].')</option>';
                } else if ($item['JENISAKUN'] == "GRUP") {
                    $select .= '<option value="' . $item['ID'] . '">' . $indentation . $item['KODE_COA_GROUP'] . ' - ' . $item['NAMA_COA_GROUP'] . ' ('.$item['DEFAULTINPUT'].')</option>';
                } else if ($item['JENISAKUN'] == "LEDGER") {
                    $select .= '<option value="' . $item['ID'] . '">' . $indentation . $item['KODE_COA_GROUP'] . ' - ' . $item['NAMA_COA_GROUP'] . ' ('.$item['DEFAULTINPUT'].')</option>';
                } else {
                    $select .= '<option style="color:black" value="' . $item['ID'] . '">' . $indentation . $item['KODE_COA_GROUP'] . ' - ' . $item['NAMA_COA_GROUP'] . ' ('.$item['DEFAULTINPUT'].')</option>';
                }
            }   
        }
        if (isset($item['children']) && !empty($item['children'])) {
            $select .= generateSelectTreeViewledger($item['children'], $idnya, $hanyapilihleder, $level + 1);
        }
    }
    if ($level === 0) {
        $select .= '</select>';
    }
    return $select;
}