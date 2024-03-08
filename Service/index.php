<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container">

    <div class="card-container">

        <div class="front">
            <div class="image">
                <img src="chip.png" alt="">
                <img src="visa.png" alt="">
            </div>
            <div class="card-number-box">################</div>
            <div class="flexbox">
                <div class="box">
                    <span>card holder</span>
                    <div class="card-holder-name">full name</div>
                </div>
                <div class="box">
                    <span>expires</span>
                    <div class="expiration">
                        <span class="exp-month">mm</span>
                        <span class="exp-year">yy</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="back">
            <div class="stripe"></div>
            <div class="box">
                <span>cvv</span>
                <div class="cvv-box"></div>
                <img src="image/visa.png" alt="">
            </div>
        </div>

    </div>

    <form action="card.php" method="post">
        <div class="inputBox">
            <span>card number</span>
            <input type="number" maxlength="15" class="card-number-input" name="card_number" required>
        </div>
        <div class="inputBox">
            <span>card holder</span>
            <input type="text" pattern="[A-Za-z ]+" class="card-holder-input" name="card_holder" title="Only characters are allowed"required>
        </div>
        <div class="flexbox">
            <div class="inputBox">
                <span>expiration mm</span>
                <select name="expiration_month" id="" class="month-input" required>
                    <option value="month" selected disabled>month</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
            <div class="inputBox">
                <span>expiration yy</span>
                <select name="expiration_year" id="" class="year-input" required>
                    <option value="year" selected disabled>year</option>
                    <!-- <option value="2021">2021</option> -->
                    <!-- <option value="2022">2022</option> -->
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                    <option value="2030">2031</option>
                    <option value="2030">2032</option>
                    <option value="2030">2033</option>
                </select>
            </div>
            <div class="inputBox">
                <span>cvv</span>
                <input type="number" maxlength="3" class="cvv-input" name="cvv" title="Only Number is allowed of length 3" required>
            </div>
            
        </div>
        <div class="input-box amount-box">
            <label>Amount:</label>
            <input type="text" name="amount" value="₹2000" readonly/>
        </div>
        
        <input type="text" id="invoice-number" name="invoice_number" value="" readonly>
        <input type="submit" value="Make Payment" class="submit-btn">
    </form>

</div>    

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const invoiceNumber = urlParams.get('invoice');
    document.getElementById('invoice-number').value = invoiceNumber;



document.querySelector('.card-number-input').oninput = () =>{
    document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
}

document.querySelector('.card-holder-input').oninput = () =>{
    document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
}

document.querySelector('.cvv-input').onmouseenter = () =>{
    document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
    document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
}

document.querySelector('.cvv-input').onmouseleave = () =>{
    document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
    document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
}

document.querySelector('.cvv-input').oninput = () =>{
    document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;

}

document.querySelector('.year-input').oninput = () => {
    const yearInput = document.querySelector('.year-input');
    const monthInput = document.querySelector('.month-input');
    const currentYear = new Date().getFullYear();

    if (yearInput.value == currentYear) {
        const currentMonth = new Date().getMonth() + 1; // Adding 1 since getMonth() returns zero-based month
        const monthOptions = monthInput.options;

        for (let i = 0; i < monthOptions.length; i++) {
            const monthValue = parseInt(monthOptions[i].value);
            if (monthValue < currentMonth) {
                monthOptions[i].disabled = true;
            } else {
                monthOptions[i].disabled = false;
            }
        }
    } else {
        // Enable all month options if a different year is selected
        const monthOptions = monthInput.options;
        for (let i = 0; i < monthOptions.length; i++) {
            monthOptions[i].disabled = false;
        }
    }

    document.querySelector('.exp-year').innerText = yearInput.value;
}

</script>
<script>
    // Function to validate the card number
    function validateCardNumber() {
        const cardNumberInput = document.querySelector('.card-number-input');
        const cardNumberBox = document.querySelector('.card-number-box');
        const cardNumber = cardNumberInput.value.trim();

        // Validate if the card number has exactly 16 digits
        if (cardNumber.length !== 16 || isNaN(cardNumber)) {
            cardNumberBox.innerText = 'Invalid Card Number';
        } else {
            cardNumberBox.innerText = cardNumber;
        }
    }

    // Function to validate the card holder name
    function validateCardHolderName() {
        const cardHolderInput = document.querySelector('.card-holder-input');
        const cardHolderName = document.querySelector('.card-holder-name');
        const regex = /^[A-Za-z\s]+$/; // Regular expression to match only letters and spaces

        // Validate if the card holder name contains only letters and spaces
        if (!regex.test(cardHolderInput.value)) {
            cardHolderName.innerText = 'Invalid Name';
        } else {
            cardHolderName.innerText = cardHolderInput.value;
        }
    }

    // Function to validate the CVV
    function validateCVV() {
        const cvvInput = document.querySelector('.cvv-input');
        const cvvBox = document.querySelector('.cvv-box');
        const cvv = cvvInput.value.trim();

        // Validate if the CVV has exactly 3 digits
        if (cvv.length !== 3 || isNaN(cvv)) {
            cvvBox.innerText = 'Invalid CVV';
        } else {
            cvvBox.innerText = cvv;
        }
    }

    // Add event listeners for input and change events on the input fields
    document.querySelector('.card-number-input').addEventListener('input', validateCardNumber);
    document.querySelector('.card-holder-input').addEventListener('input', validateCardHolderName);
    document.querySelector('.cvv-input').addEventListener('input', validateCVV);
</script>

</body>
</html>