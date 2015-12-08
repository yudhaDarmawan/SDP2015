<div class='content'>
    <h4 style="text-align: center;text-transform: uppercase;margin-top:0px"><?php echo $tahun_ajaran;?></h4>
<?php
	echo $this->table->generate()."<br/>";
	$this->table->clear();
	echo '<table autosize="1.6" border="1" cellspacing="0" width="100%" cellpadding="5"><thead>
        <tr>

            <td>No</td>
            <td>NRP</td>
            <td>Nama</td>';
    if ($allow_data['uts']){
        echo '<td>UTS</td>';
    }
    if ($allow_data['tugas']){
        echo '<td>Tugas</td>';
    }
    if ($allow_data['uas']){
        echo '<td>UAS</td>';
    }
    if ($allow_data['nilai_akhir']){
        echo '<td>NA</td>';
    }
    if ($allow_data['nilai_akhir_grade']){
        echo '<td>NA+</td>';
    }
    if ($allow_data['nilai_grade']) {
        echo '<td>Grade</td>';
    }
    echo  '<td>Ket</td></tr></thead><tbody>';

        foreach ($students as $student) {
            if (ord($minGrade) < ord($student[8])) {
                echo '<tr style="background:yellow">';
            } else {
                echo '<tr>';
            }
            echo "<td>" . $student[0] . "</td>";
            echo "<td>" . $student[1] . "</td>";
            echo "<td>" . $student[2] . "</td>";
            if ($allow_data['uts'])
            echo "<td align='right'>" . $student[3] . "</td>";
            if ($allow_data['tugas'])
            echo "<td align='right'>" . $student[4] . "</td>";
            if ($allow_data['uas'])
            echo "<td align='right'>" . $student[5] . "</td>";
            if ($allow_data['nilai_akhir'])
            echo "<td align='right'>" . $student[6] . "</td>";
            if ($allow_data['nilai_akhir_grade'])
            echo "<td align='right'>" . $student[7] . "</td>";
            if ($allow_data['nilai_grade'])
            echo "<td >" . $student[8] . "</td>";
            if (ord($minGrade) < ord($student[8])) {
                echo "<td>TIDAK LULUS</td>";
            }
            else{
                echo "<td>LULUS</td>";
            }
            echo "</tr>";
        }

        echo "</tbody></table>";

    echo "Total Mahasiswa : ".count($students)." <br><br>";
    foreach ($percentage as $key => $value){
        if($key != 'IP Dosen') {
            echo $key . " : " . $value . "% <br/>";
        }
    }

?>
	</div>