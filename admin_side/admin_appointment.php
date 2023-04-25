<?php
include('admin_index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin_side_css/admin_appointment.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Appointment</title>
</head>
<body>
    <div class="title" style="cursor: default;">
        <h1 class="maintitle">Appointments</h1>
            <h2 class="subtitle">Peek at the schedule of events with the best Doctor's Appointment System.</h2>
    </div>

<center>
  <table class="table table-hover" style="width:80%; margin-left:250px; margin-top:-10px; cursor:default;">
    <thead>
      <tr>
        <th scope="col" style="width:15%;">Appt Number</th>
        <th scope="col">Patient Name</th>
        <th scope="col">Doctor</th>
        <th scope="col">Appointment Date</th>
      </tr>
    </thead>

    <tbody>
      <?php
        include '../database/security.php';
        $sql = 'SELECT booking.appointment_id ,booking.doc_id, booking.patient_name, booking.`patient_app-date`, 
        doctor.doctor_name FROM booking
        INNER JOIN doctor ON  booking.doc_id = doctor.doctor_id;';
        $result = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_assoc($result)){
          echo '<tr>';
          echo '<th scope="row">'.$row['appointment_id'].'</th>';
          echo '<td>'.$row['patient_name'].'</td>';
          echo '<td>'.$row['doctor_name'].'</td>';
          echo ' <td>'.$row['patient_app-date'].'</td>';
          echo '</tr>';
        }
      ?>
    </tbody>
  </table>
</center>

</body>
</html>