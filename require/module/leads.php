<?php
//lead stage
DEFINE("LEAD_STAGES", array(
 "FRESH_LEAD" => "Fresh Lead",
 "REQ_ANALYSIS" => "Required Analysis",
 "MEETING" => "Meeting",
 "QUOTATION_AND_PROPOSAL" => "Quotation and Proposal",
 "WAITING_FOR_APPROVAL" => "Waiting For Approval",
 "APPROVED_WON" => "Approved Won",
 "REJECTED_LOST" => "Rejected Lost"
));


//function for lead call reminders
function DisplayReminder($REQ_LeadsId)
{
 $CurrentData = date("Y-m-d");
 $FetchCalls = FetchConvertIntoArray("SELECT * FROM leads_calls where DATE(LeadCallingReminderDate)<='$CurrentData' and LeadCallStatus='FollowUp' and LeadMainId='$REQ_LeadsId' ORDER BY LeadCallId DESC limit 1", true);
 if ($FetchCalls != null) {
  foreach ($FetchCalls as $Calls) {
   return Reminder();
  }
 }
}

//function display lead id
function LEADID($id)
{
 echo "LEADID00" . $id;
}
