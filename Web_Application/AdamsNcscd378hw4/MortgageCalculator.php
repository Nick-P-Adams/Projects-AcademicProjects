<?php
/*
Nick Adams
This is the php file where we take input from the HTML form and then process it for output. Specifically we are taking input validating 
if the input is not valid we are outputing what is invalid. Assuming all input is vaild we are doing some calculations for a mortgage.
Figuring out monthly payments as well as how much interest and principle is paid each month until the loan has reached it's final term.
*/

$firstName = $_POST["fname"];
$lastName = $_POST["lname"];
$street = $_POST["street"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$type = $_POST["ptype"];
(double) $principal = $_POST["loan"];
(double) $interest = $_POST["irate"];
(int) $term = $_POST["loanLength"];

if($firstName == "" || $lastName == "")
{
	echo "You cannot leave either field in the Enter Name section blank please hit the back button and fill out both fields"; 
}
elseif($street == "" || $city == "" || $state == "" || $zip == "")
{ 
	echo "You cannot leave any field in the Enter Address field blank please hit the back button and fill out all sections";
}
elseif($principal == 0)
{
	echo "You cannot leave the loan amount as 0 please hit the back button and enter a value greater than 0";
}
else
{
	$totalInterestPaid = 0.0;
	$remainingPrincipal = $principal;

	$months = $term*12;
	$monthlyInterest =($interest/100.0)/12.0;
	$monthlyPayment = round(($principal * (($monthlyInterest * (pow((1+$monthlyInterest), $months)))/(pow((1+$monthlyInterest), $months)-1))), 2);

	echo $firstName . "  " . $lastName . "<br>" . $street . "<br>" . $city . ", " . $state . " " . $zip . 
		"<br><br>" . "Property: " . $type . "<br>" . "Total Loan: $" . $principal . "  Term: " . $months .
		" Months<br>Interest Rate: " . $interest . "%<br>Monthly Payment: $" . $monthlyPayment . "<br><br>";
	 
	echo "<pre>Month          Principal owed       Interest Paid         Principal Paid      Remaining Principal</pre><br><br>";	 
	for($i = 0; $i < $months; $i++)
	{
		$interestPaid = round(($monthlyInterest*$remainingPrincipal), 2);
		$principalPaid = round(($monthlyPayment - $interestPaid), 2);
		$totalInterestPaid += round($interestPaid, 2);
		$curMonth = $i+1;
		$remainingPrincipal = round($remainingPrincipal, 2);
		echo "<pre>$curMonth             $remainingPrincipal";
		$remainingPrincipal -= $principalPaid;
		$roundRP = round($remainingPrincipal, 2);
		echo "             $interestPaid                $principalPaid              $roundRP</pre><br>";
	}

	echo "Total Interest Paid: $" . $totalInterestPaid;
}
?>
