<?php
//export.php
if(!empty($_FILES["excel_file"]))
{
    $connect = mysqli_connect("bsu", "root", "root", "bsu_test");
    mysqli_set_charset($connect, "windows-1251");
    $file_array = explode(".", $_FILES["excel_file"]["name"]);
    if($file_array[1] == "xlsx")
    {
        include("PHPExcel/Classes/PHPExcel/IOFactory.php");
        $output = '';
        $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr>  
                          <th>Фамилия</th>  
                          <th>Имя</th>  
                          <th>Отчетсво</th>  
                          <th>Email</th>  
                          <th>Страна</th>  
                          <th>Город</th>  
                          <th>Логин</th> 
                          <th>Пароль</th>   
                     </tr>  
                     ";
        $object = PHPExcel_IOFactory::load($_FILES["excel_file"]["tmp_name"]);
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            $highestRow = $worksheet->getHighestRow();
            for($row=2; $row<=$highestRow; $row++)
            {
                $surname = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                var_dump($surname);
                $name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                $midname = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                $email = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                $country = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                $city = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                $login = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                $password = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                var_dump($midname,$email,$country);

                $sql ="INSERT INTO user (surname,name,midname,email,country,city,login,password) VALUES('$surname','$name','$midname','$email','$country','$city','$login',$password)";

                if (mysqli_query($connect, $sql)) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
                }

                $output .= '  
                     <tr>  
                          <td>'.$surname.'</td>  
                          <td>'.$name.'</td>  
                          <td>'.$midname.'</td>  
                          <td>'.$email.'</td>  
                          <td>'.$country.'</td>  
                          <td>'.$city.'</td>  
                          <td>'.$login.'</td>  
                          <td>'.$password.'</td>  
                     </tr>  
                     ';
            }
        }
        $output .= '</table>';
        echo $output;
    }
    else
    {
        echo '<label class="text-danger">Invalid File</label>';
    }
}
?>