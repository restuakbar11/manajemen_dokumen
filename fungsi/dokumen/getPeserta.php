<?php
include "../../config/connect.php";
$id_supp = $_POST['supp'];
	$no=0;
        $getData =mysqli_query($koneksi,"SELECT M_MeetingParticipantID,M_MeetingParticipantM_SupplierID,M_MeetingParticipantName FROM m_meetingparticipant
WHERE M_MeetingParticipantM_SupplierID IN ('$id_supp','9999')");
        while($r =mysqli_fetch_array($getData)){ 
        	$no++; ?>
			<div class="form-check">
			    <div class="checkbox">
			        <label for="checkbox1" class="form-check-label ">
			            <input type="checkbox" name="peserta[]" value="<?php echo $r['M_MeetingParticipantID'] ?>" class="form-check-input"><?php echo $r['M_MeetingParticipantName'] ?>
			        </label>
			    </div>
			    
			</div>

        <?php } ?>
