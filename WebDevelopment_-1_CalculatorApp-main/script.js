/*How to store the data? We will use a calculator class for the same*/
class Calculator{
    constructor(previousOperandTextElement, currentOperandTextElement) {/*it will take all the inputs and all the functions for our calculator*/
    this.previousOperandTextElement = previousOperandTextElement; /*This gives us a way to set these text elements in our calcualtor class */
    this.currentOperandTextElement = currentOperandTextElement;
    this.clear() /* This needs to be immediate so as to clear the whole calculator display window as soon the same has been loaded */
    }

    clear(){
        this.currentOperand = '' /*Q. Can I use " " safely? */
        this.previousOperand = ''
        this.operation = undefined /*So that no operation is selected when the data on screen is cleared */
    }

    delete(){
        this.currentOperand = this.currentOperand.toString().slice(0,-1)
    }

    appendNumber(number){
        /*This if return element stops adding more than once decimal*/
        if(number==='.' && this.currentOperand.includes('.')) return
        /*JS will try to add these numbers if you don't convert them to a string*/
        this.currentOperand = this.currentOperand.toString() + number.toString()
    }

    chooseOperation(operation){
        /*Current Operand works even if there is no value added. This check stops that */
        if (this.currentOperand === '') return
        /*If the previous operand is not empty, we want to do the computation */
        if (this.previousOperand !== '') {
            this.compute()
        }
        this.operation = operation
        this.previousOperand = this.currentOperand
        this.currentOperand = ''
    }

    compute(){
        let compuatation
        const prev = parseFloat(this.previousOperand)
        const current = parseFloat(this.currentOperand)
        /*We don't want the code to run if there is no number entered*/
        if(isNaN(prev) || isNaN(current)) return
        switch (this.operation) {
            
        case '+':
            compuatation = prev + current
            break
        case '-':
            compuatation = prev - current
            break
        case '*':
            compuatation = prev * current
            break
        case '/':
            compuatation = prev / current
            break
        default:
            return
        }
        this.currentOperand = compuatation
        this.operation = undefined
        this.previousOperand = ''

    }

getDisplayNumber(number){
    const stringNumber = number.toString()
    const integerDigits = parseFloat(stringNumber.split('.')[0])
    const decimalDigits = stringNumber.split('.')[1]
    let integerDisplay
    if (isNaN(integerDigits)) {
        integerDisplay = ''
    } else {
        integerDisplay = integerDigits.toLocaleString('en', {maximumFractionDigits: 0})
    }

    if (decimalDigits != null){
        return `${integerDisplay}.${decimalDigits}`
    } else {
        return integerDisplay
    }

    /*
    This seems to be a much simpler answer but it doesn't work with decimals
    const floatNumber = parseFloat(number)
    if (isNaN(floatNumber)) return ''
    return floatNumber.toLocaleString('en');
    */
}

    updateDisplay(){
        this.currentOperandTextElement.innerText = this.getDisplayNumber(this.currentOperand)
        if (this.operation != null){
            this.previousOperandTextElement.innerText = `${this.getDisplayNumber(this.previousOperand)} ${this.operation}`
        }
        else {
            this.previousOperandTextElement.innerText = ''
        }
    }
}


/*This selects all the data-number attributes*/
const numberButtons = document.querySelectorAll('[data-number]')
const operationButtons = document.querySelectorAll('[data-operation]') //This returns all the buttons with data-operation
const equalsButton = document.querySelector('[data-equals]') //This selects the single equals button
const deleteButton = document.querySelector('[data-delete]')
const allClearButton = document.querySelector('[data-all-clear]')
const previousOperandTextElement = document.querySelector('[data-previous-operand]')
const currentOperandTextElement = document.querySelector('[data-current-operand]')

/*Defining a new class */
const calculator = new Calculator(previousOperandTextElement, currentOperandTextElement)

numberButtons.forEach(button => {
    button.addEventListener('click', () => {
        calculator.appendNumber(button.innerText)
        calculator.updateDisplay()
    })
})

operationButtons.forEach(button => {
    button.addEventListener('click', () => {
        calculator.chooseOperation(button.innerText)
        calculator.updateDisplay()
    })
})

equalsButton.addEventListener('click', button =>{
    calculator.compute()
    calculator.updateDisplay()
})

allClearButton.addEventListener('click', button =>{
    calculator.clear()
    calculator.updateDisplay()
})

deleteButton.addEventListener('click', button =>{
    calculator.delete()
    calculator.updateDisplay()
})