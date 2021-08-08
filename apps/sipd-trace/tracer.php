<?php
//return $cat1,$cat2;
?>
<hr />
ref-kode-kelompok:<select name="kelompok" class="bl-select">
<?php
    $fileHandle = fopen("ref-kode-kelompok.csv", "r");
    while (($row = fgetcsv($fileHandle, 0, ";")) !== FALSE) {
        $cat1 = $row[0];
        $cat2 = $row[1];
?>
    <option value="<?php echo $cat1;?>"><?php echo $cat1 ." ". $cat2;?></option>
<?php
    }
?>
</select>
<br /><hr />
ref-kode-rekeing:<select name="rekening" class="bl-select">
<?php
    $fileHandle = fopen("ref-kode-rekeing.csv", "r");
    while (($row = fgetcsv($fileHandle, 0, ";")) !== FALSE) {
        $cat1 = $row[0];
        $cat2 = $row[1];
?>
    <option value="<?php echo $cat1;?>"><?php echo $cat1 ." ". $cat2;?></option>
<?php
    }
?>
</select>
<br /><hr />
ref-kode-satuan:<select name="satuan" class="bl-select">
<?php
    $fileHandle = fopen("ref-kode-satuan.csv", "r");
    while (($row = fgetcsv($fileHandle, 0, ";")) !== FALSE) {
        $cat1 = $row[0];
        $cat2 = $row[1];
?>
    <option value="<?php echo $cat1;?>"><?php echo $cat1 ." ". $cat2;?></option>
<?php
    }
?>
</select>
<br /><hr />
