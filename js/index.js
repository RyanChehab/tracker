const income = document.getElementById('income');
const expense = document.getElementById('expense');
const income_sheet = document.getElementById("income_sheet");
const expense_sheet = document.getElementById("expense_sheet");
const portal = document.getElementById('portal');
const add_income = document.getElementById('add-income');
let balance=0;
const budget = document.getElementById('budget');

// toggele showing the transaction pages
function toggleSheet(showSheet, hideSheet) {
    showSheet.classList.remove('d-none');
    showSheet.classList.add('d-block');
    hideSheet.classList.remove('d-block');
    hideSheet.classList.add('d-none');
}

// Event listeners for income and expense buttons
income.addEventListener('click', function() {
    toggleSheet(income_sheet, expense_sheet);
    console.log("work")
});

expense.addEventListener('click', function() {
    toggleSheet(expense_sheet, income_sheet);
});

// close portal
const close_btn = document.getElementById('close_btn')
close_btn.addEventListener('click',function(){
    portal.classList.add('d-none')
    const overlay = document.getElementById('overlay')
    overlay.classList.add('d-none')
})
// add-income btn
add_income.addEventListener('click',function(){
    portal.classList.remove('d-none')
    const overlay = document.getElementById('overlay')
    overlay.classList.remove('d-none')
    const portal_title = document.getElementById('top-title')
    portal_title.innerText = 'Add Income';
     // calling to inject the dynamic form
    injectForm("income")
})

// add-expense btn
const add_expense = document.getElementById('add-expense')
add_expense.addEventListener('click',function(){
    portal.classList.remove('d-none')
    const overlay = document.getElementById('overlay')
    overlay.classList.remove('d-none')
    const portal_title = document.getElementById('top-title')
    portal_title.innerText = 'Add Expense';
    // calling to inject the dynamic form
    injectForm("expense")
})

async function read(){
    try{
        const response = await fetch('../backend/read.php',{
            method: 'POST',
            headers:{
                'Content-Type':'application/json'
            }    
        });
        const data = await response.json();
        displayTransaction(data);
    } catch(error){
        console.error("Error fetching transaction:", error);
    }
}


async function create() {
    try{

        const response = await fetch('../backend/create.php',{
            method: 'POST',
            headers:{
                'Content-Type':'application/json'
            }
        });
        const data = await response.json();

    }catch(error){
        console.error("Error sending data")
    }
}




// function injectForm(type) {
//     const portal_top = document.getElementById('portal_top');

//     // If portal_top has a form, delete it
//     const existsForm = portal_top.querySelector('.Form');
//     if (existsForm) {
//         portal_top.removeChild(existsForm);
//     }

//     // Create form based on type (income or expense)
//     let form = document.createElement('div');
//     form.classList.add("inputForm");
//     form.innerHTML = `
//         <form id="transactionForm">
//             <div class="flex align-center gap-2">
//                 <label for="number">Amount</label>
//                 <input type="number" name="number" id="amount" placeholder="$" required>
//             </div>
//             <br><br><br>
//             <div class="flex align-center gap-3">
//                 <label for="date">Date</label>
//                 <input type="date" id="date" required>
//             </div>  
//             <br><br><br>
//             <div class="flex gap-1">
//                 <label for="description">Description</label>
//                 <input type="text" id="description" required>
//             </div>
//             <div class="submit-div">
//                 <button class="submit-btn" id="saving-btn" type="submit">Save</button>
//             </div>
//         </form>`;

//     portal_top.append(form);


// function injectTransaction(data) {
//     data.forEach(transaction=>{
//         const form = document.createElement('div')
//         form.innerHTML = `
//         <div class="transForm-${transaction.type}" >
//              <div class="flex space-between m-1">
//                  <p>${transaction.type}</p>
//                  <i class="delete fas fa-minus" title="Delete transaction" id="${transaction.id}"></i>
//              </div>
//              <hr style="border-color:black;">
//              <p>Amount: ${transaction.amount}</p>
//              <p>Date: ${transaction.date}</p>
//             <p>Description: ${transaction.description}</p>
//       </div>`;
// })
// }

// }