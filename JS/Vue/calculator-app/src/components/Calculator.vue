<template>
  <div class="calculator">
    <input type="text" v-model="display" readonly />
    <div class="buttons">

      <button class="operator" @click="clear">C</button>
      <button @click="append('7')">7</button>
      <button @click="append('8')">8</button>
      <button @click="append('9')">9</button>
      <button class="operator" @click="append('/')">/</button>
      <button @click="append('4')">4</button>
      <button @click="append('5')">5</button>
      <button @click="append('6')">6</button>
      <button class="operator" @click="append('*')">*</button>
      <button @click="append('1')">1</button>
      <button @click="append('2')">2</button>
      <button @click="append('3')">3</button>
      <button class="operator" @click="append('-')">-</button>
      <button @click="append('0')">0</button>
      <button @click="append('.')">.</button>
      <button class="operator" @click="calculate()">=</button>
      <button class="operator" @click="append('+')">+</button>
    </div>
  </div>
</template>

<script>

export default {
  name: 'SimpleCalculator',
  data() {
    return {
      display: '',
      operator: null,
      operand1: null,
      operand2: null,
    };
  },
  methods: {
    clear() {
      this.display = '';
      this.operator = null;
      this.operand1 = null;
      this.operand2 = null;
    },
    append(value) {
      if (value === '+' || value === '-' || value === '*' || value === '/') {
        this.operator = value;
        this.operand1 = parseFloat(this.display);
        this.display = '';
      } else if (value === '=') {
        this.calculate();
      } else {
        this.display += value;
      }
    },
    calculate() {
    this.operand2 = parseFloat(this.display);
    let result = 0;
    switch (this.operator) {
      case '+':
        result = this.operand1 + this.operand2;
        break;
      case '-':
        result = this.operand1 - this.operand2;
        break;
      case '*':
        result = this.operand1 * this.operand2;
        break;
      case '/':
        result = this.operand1 / this.operand2;
        break;
    }
    this.display = result.toString();
    this.operator = null;
    this.operand1 = null;
    this.operand2 = null;
  },
  },
};
</script>

<style scoped>
.calculator {
  width: 200px;
  margin: auto;
}
.buttons button {
  width: 40px;
  height: 40px;
  margin: 5px;
}
.operator {
  background-color: #f0f0f0;
  color: #333;
}
</style>
