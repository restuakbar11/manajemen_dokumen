<?php
session_start();
include "../../config/connect.php";
$id = $_POST['id_dokumen'];
$output = "";
$no = 0;
$query = mysqli_query($koneksi,"SELECT M_MeetingParticipantName FROM t_documentmeeting a
INNER JOIN m_meetingparticipant b ON a.T_DocumentMeetingParticipantID=b.M_MeetingParticipantID 
WHERE b.M_MeetingParticipantIsActive = 'Y' AND a.T_DocumentMeeting_T_documentID = '$id'");
while($row=mysqli_fetch_array($query)) {
     $no++;
	$peserta = $row['M_MeetingParticipantName'];

     $output .= '
<div>  
     <table >'; 
     $output .= '  
          <tr>  
               <td width="5%"><label>'.$no.'</label></td>  
               <td width="80%"><a href="#" target="_blank" >'.$peserta.'</td></a>
          </tr>

          ';    
$output .= "
     </table>
</div>"; 
}


	
echo $output;  