<div class='content'>

<?php
	echo $this->table->generate();
	$this->table->clear();
	echo '<table autosize="1.6" border="1" cellspacing="0" width="100%" cellpadding="5"><thead>
        <tr>
            <td>No</td>
            <td>NRP</td>
            <td>Nama</td>
            <td>UTS</td>
            <td>Tugas</td>
            <td>UAS</td>
            <td>NA</td>
            <td>NA+</td>
            <td>Grade</td>
        </tr>
</thead><tbody>';

        foreach ($students as $student) {
            if (ord($minGrade) < ord($student[8])) {
                echo '<tr style="background:yellow">';
            } else {
                echo '<tr>';
            }
            echo "<td>" . $student[0] . "</td>";
            echo "<td>" . $student[1] . "</td>";
            echo "<td>" . $student[2] . "</td>";
            echo "<td align='right'>" . $student[3] . "</td>";
            echo "<td align='right'>" . $student[4] . "</td>";
            echo "<td align='right'>" . $student[5] . "</td>";
            echo "<td align='right'>" . $student[6] . "</td>";
            echo "<td align='right'>" . $student[7] . "</td>";
            echo "<td >" . $student[8] . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";

    echo "Total Mahasiswa : ".count($students)." <br><br>";
    foreach ($percentage as $key => $value){
        echo "Prosentase ".$key." : ".$value."% <br/>";
    }

?>
	</div>