var r1counter = 0;
var r2counter = 0;
var r3counter = 0;
var ukwcounter = 0;

function enigma(input) {
	if(input == ' ') {
		return input;
	}
	
	console.log(ukws);
	console.log(rotors);
	
	
	console.log('converting Patchpanel:');
	
	var r1out = procRotor('rotor1', input);
	var r2out = procRotor('rotor2', r1out);
	var r3out = procRotor('rotor3', r2out);
	var ukwout = procRotor('ukw', r3out);
	var r3out = procRotor('rotor3', ukwout);
	var r2out = procRotor('rotor2', r3out);
	var r1out = procRotor('rotor1', r2out);
	
	console.log('final output: ' + r1out);
	
	return r1out;
}

function procRotor(rotor, input) {
	console.log('input for '+rotor+': '+input);
	var rotorVal = $('#'+rotor).val();
	var rotorLetter = $('#'+rotor+'Letter').val();
	var rOut = rotors[rotorVal][rotorLetter];
	console.log('output for '+rotor+': '+rOut);
	rotorsAdvance();
	return rOut;
}

function rotorAdvance(rotor, counter) {
	var rNext = $('#'+rotor+'Letter option:selected').next().val();
	if(typeof rNext == 'undefined') {
		rNext = '0';
	}
	$('#'+rotor+'Letter').val(rNext);
	$('#'+rotor+'Letter').trigger('change');
	$('#'+rotor+'Counter').html(counter);
}

function rotorsAdvance() {
	console.log('advancing rotors...');
	
	//Always advance 1st rotor:
	r1counter++;
	rotorAdvance('rotor1', r1counter);
	
	if(r1counter == 26) {
		//reset 1st rotor counter:
		r1counter = 0;
		//advance 2nd rotor:
		r2counter++;
		rotorAdvance('rotor2', r2counter);
	}
	
	if(r2counter == 26) {
		//reset 2nd rotor counter:
		r2counter = 0;
		//advance 3rd rotor:
		r3counter++;
		rotorAdvance('rotor3', r3counter);
	}
	
	if(r3counter == 26) {
		//reset 3rd rotor counter:
		r3counter = 0;
		//advance ukw rotor:
		ukwcounter++;
		rotorAdvance('ukw', ukwcounter);
	}
	
	if(ukwcounter == 26) {
		//reset ukw rotor counter:
		ukwcounter = 0;
	}
}