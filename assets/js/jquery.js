function detectWord(str) {
    let word = '';
    for (let i = 0; i < str.length; i++) {
      let ch = str.charAt(i);
      if (ch >= 'a' && ch <= 'z') {
        word += ch;
      }
    }
    return word;
  }

  //Detect Hiiden Word

  $(document).ready(function() {
    $('#detectBtn').click(function() {
      let input = $('#inputText').val();
      let result = detectWord(input);
      $('#result').text('Hidden word: ' + result);
    });

    $('#replaceBtn').click(function() {
      let inputText = $('#textInput').val();
      let resultText = inputText.replace(/nice/gi, 'bad');
      $('#result1').text('Result: ' + resultText);
    });
  });

  // age convert

  function getAge(birthDate) {
      const today = new Date();
      const birth = new Date(birthDate);
      let age = today.getFullYear() - birth.getFullYear();
      const monthDiff = today.getMonth() - birth.getMonth();

      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
        age--;
      }

      return age;
    }

    $(document).ready(function() {
      $('#calculateBtn').click(function() {
        const birthday = $('#birthday').val();
        if (birthday) {
          const age = getAge(birthday);
          $('#ageResult').text('You are ' + age + ' years old.');
        } else {
          $('#ageResult').text('Please enter a valid birthday.');
        }
      });
    });

    //Return specific date 

    $(document).ready(function() {
      $('#getDayBtn').click(function() {
        const inputDate = $('#dateInput').val();
        if (inputDate) {
          const date = new Date(inputDate);
          const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
          const dayName = days[date.getDay()];
          $('#dayResult').text('That date is a ' + dayName + '.');
        } else {
          $('#dayResult').text('Please select a valid date.');
        }
      });
    });