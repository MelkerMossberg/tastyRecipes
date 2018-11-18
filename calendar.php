<?php
require "header.php";
 ?>

<div class="container">
  <div id="header" class="row my-4">
      <div class="col-sm-2">
          <a href="#" id="back-btn">Back</a>
      </div>
      <div id="month" class="col-sm-6 text-center"></div>
      <div class="col-sm-2 text-right ml-3">
          <a href="#" id="next-btn">Next</a>
      </div>
  </div>
  <div id="calendar" class="mb-5"></div>
</div>

<script>
    events = [
        {title: 'PankaksDagen', year: 2018, month: 11, day: 4, link: 'recipe/7', img: 'https://img.koket.se/media/pannkakor-recept-recept-nu.jpg' },
        {title: 'Köttbulledagen', year: 2018, month: 11, day: 16, link: 'recipe/6', img: 'https://img.koket.se/media/kottbullar-pelle-johanssons-recept2.jpg' },
        {title: 'Lucia', year: 2018, month: 12, day: 13, link: 'recipe/8',img: 'https://img.koket.se/media/annas-saftiga-lussebullar-med-kesella.jpg' }
    ];

    const date = new Date();

    generateHeading();
    generateCalendar();
    addEvents(events);

    /**
     * Generate the events in the calendar
     */
    function addEvents(events) {
        for (i = 0; i < events.length; i++) {
            calContent = document.createElement('div');
            leDiv = document.createElement('div');
            leDiv.style.background = 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('+ events[i].img +')';
            leDiv.innerHTML = `
            <a href="../${events[i].link}">
                <p class="mt-3">${events[i].title}</p>
            </a>
            `;
            leDiv.className = 'event';
            dateString = events[i].year + '-' + events[i].month + '-' + events[i].day;
            if (document.getElementById(dateString) != null) {
                document.getElementById(dateString).appendChild(leDiv);
            }

        }
    }

    /**
     *  Generate the calendar
     */

    function generateCalendar() {
        const calendar = document.getElementById('calendar');
        calendar.appendChild(generateCards());
    }

    function generateCards() {
        // Setup the outer div
        const cardGroup = document.createElement('div');
        cardGroup.className += 'card-group';

        // First we calculate how many "slots" will be empty in the first week in calendar in order to
        // insert them before the date-slots.
        const numOfEmptySLots = new Date(date.getFullYear(), date.getMonth(), 1).getDay() - 1;  //Calculate num of empty slots.
        console.log('NumEmptySlots ' + numOfEmptySLots);
        console.log('DaysInMonth ' + daysInMonth(11));

        // All "date-slots" (newCard) will be created as HTML elements and added to an array
        let newCard;
        const dateArray = new Array(daysInMonth(date.getMonth()) + numOfEmptySLots - 1);
        console.log('DateArrayLength ' + dateArray.length);

        // Now we generate HTML elements for all date-slots
        let d = 1; //counting variable
        const daysThisMonth = daysInMonth(date.getMonth() + 1);
        while (d <= daysThisMonth) {
            newCard = document.createElement('div');
            newCard.className = 'card date';
            newCard.id = (date.getFullYear()) + '-' + (date.getMonth() + 1) + '-' + d;
            newCard.appendChild(generateDateSlot(d));
            dateArray[d + numOfEmptySLots - 1] = newCard;
            d++;
        }

        // Then we insert "empty HTML elements" in the empty slots
        for (l = 0; l < numOfEmptySLots; l++) {
            dateArray[l] = document.createElement('div');
            dateArray[l].className = 'card date'
        }

        for (x = 0; x < dateArray.length; x++) {
            console.log(dateArray[x])
        }

        // Now we put all date-slots into 5 rows. Last row will be 2 och 3 slots, depending on month.length().
        let newRow;
        let count = 0;
        const maxDays = daysThisMonth + numOfEmptySLots;
        console.log("should print " + maxDays + " divs")
        for (week = 0; week < 6; week++) {
            if ((count) >= maxDays) break;
            newRow = document.createElement('div');
            newRow.className = 'row col-sm-12';
            for (day = 0; day < 7; day++) {
                if ((count) >= maxDays) break;
                console.log(count)
                newRow.appendChild(dateArray[count]);
                count++;
            }
            cardGroup.appendChild(newRow);
        }
        return cardGroup;
    }

    /**
     * Helper functions
     */

    function generateDateSlot(num) {
        const thisDate = new Date(date.getFullYear(), date.getMonth(), num);
        const header = document.createElement('div');
        header.innerHTML = ` <h6>${thisDate.toDateString()}</h6> `;
        header.className = 'card-header';
        return header;
    }

    function daysInMonth(month) {
        return new Date(date.getFullYear(), (month), 0).getDate();
    }

    function getMonth() {
        switch (date.getMonth()) {
            case(0):
                return 'Januari';
            case(1):
                return 'Februari';
            case(2):
                return 'Mars';
            case(3):
                return 'April';
            case(4):
                return 'Maj';
            case(5):
                return 'Juni';
            case(6):
                return 'Juli';
            case(7):
                return 'Augusti';
            case(8):
                return 'September';
            case(9):
                return 'Oktober';
            case(10):
                return 'November';
            case(11):
                return 'December';
        }
    }

    function generateHeading() {
        heading = document.createElement('h3');
        heading.innerText = getMonth(date.getMonth()) + ' ' + date.getFullYear();
        document.getElementById('month').appendChild(heading);
    }


    document.getElementById("back-btn").addEventListener("click", renderLastMonth);
    document.getElementById("next-btn").addEventListener("click", renderNextMonth);

    function renderLastMonth() {
        renderOtherMonth(-1);
    }

    function renderNextMonth() {
        renderOtherMonth(1);
    }

    function renderOtherMonth(ops) {
        document.getElementById('calendar').innerHTML = ``;
        document.getElementById('month').innerText = '';
        updateDate(ops);
        generateCalendar();
        generateHeading();
        addEvents(events);
    }

    function updateDate(operation) {
        if (operation > 0) {
            if (date.getMonth() == 12) {
                date.setFullYear(date.getFullYear() + 1);
                date.setMonth(1);

            } else {
                date.setMonth(date.getMonth() + 1);
            }
        } else {
            if (date.getMonth() == 1) {
                date.setFullYear(date.getFullYear() - 1);
                date.setMonth(12);

            } else {
                date.setMonth(date.getMonth() - 1);
            }
        }
    }

</script>
