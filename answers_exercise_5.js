function parity(num) {
  if (num%2 == 0) {
    return("even");
  } else {
    return("odd");
  }
}

function max(num1, num2, num3) {
  if ((num1 > num2) && (num1 > num3)) {
    return(num1);
  } else if (num2 > num3) {
    return(num2);
  } else {
    return(num3);
  }
}

function flipCoin() {
  if (Math.random() < 0.5) {
    return("Heads");
  } else {
    return("Tails");
  }
}

function numHeads(numFlips) {
  var numHeads = 0;
  for(var i=0; i<numFlips; i++) {
    if (flipCoin() == "Heads") {
      numHeads++;
    }
  }
  return(numHeads);
}

function headsRatio(numFlips) {
  return(numHeads(numFlips)/numFlips);
}

function padChars(n, filler) {
  var result = "";
  for(var i=0; i<n; i++) {
    result = result + filler;
  }
  return(result);
}

function numRollsToGetSix() {
  var rolls = 1;
  while(Math.random() < 5/6) {
    rolls++;
  }
  return(rolls);
}

function randomMessage() {
  if (Math.random() < 0.5) {
    return("Have a GOOD day!");
  } else {
    return("Have a BAD day!");
  }
}

function outputMessage() {
  document.write("<h1 style='font-size: 600%'>" + randomMessage() + "</h1>");
}
