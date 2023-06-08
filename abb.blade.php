<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drag Drop Cards Game jQuery UI</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
    <link rel="stylesheet" href="./style.css">
</head>
<style>
/* Add some margin to the page and set a default font and colour */

body {
    margin: 30px;
    font-family: "Georgia", serif;
    line-height: 1.8em;
    color: #333;
}

/* Give headings their own font */

h1,
h2,
h3,
h4 {
    font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}

/* Main content area */

#content {
    margin: 80px 70px;
    text-align: center;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
}

/* Header/footer boxes */

.wideBox {
    clear: both;
    text-align: center;
    margin: 70px;
    padding: 10px;
    background: #wh;
    border: 1px solid #333;
}

.wideBox h1 {
    font-weight: bold;
    margin: 20px;
    color: #666;
    font-size: 1.5em;
}

/* Slots for final card positions */

#cardSlots {
    margin: 50px auto 0 auto;
    background: #ddf;
}

/* The initial pile of unsorted cards */

#cardPile {
    margin: 0 auto;
    background: #ffd;
}

#cardSlots,
#cardPile {
    width: 910px;
    height: 120px;
    padding: 20px;
    border: 2px solid #333;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    -moz-box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
    -webkit-box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
    box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
}

/* Individual cards and slots */

#cardSlots div,
#cardPile div {
    float: left;
    width: 70px;
    height: 78px;
    padding: 10px;
    padding-top: 20px;
    padding-bottom: 0;
    border: 2px solid #333;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    margin: 0 0 0 10px;
    background: #fff;
}

#cardSlots div:first-child,
#cardPile div:first-child {
    margin-left: 0;
}

#cardSlots div.hovered {
    background: #aaa;
}

#cardSlots div {
    border-style: dashed;
}

#cardPile div {
    background: #666;
    color: #fff;
    font-size: 50px;
    text-shadow: 0 0 3px #000;
}

#cardPile div.ui-draggable-dragging {
    -moz-box-shadow: 0 0 .5em rgba(0, 0, 0, .8);
    -webkit-box-shadow: 0 0 .5em rgba(0, 0, 0, .8);
    box-shadow: 0 0 .5em rgba(0, 0, 0, .8);
}

/* Individually coloured cards */

#card1.correct {
    background: #f2d9e6;
}
#card2.correct {
    background: #ecc6d9;
}
#card3.correct {
    background: #e6b3cc;
}
#card4.correct {
    background: #df9fbf;
}
#card5.correct {
    background: #d98cb3;
}
#card6.correct {
    background: #d279a6;
}
#card7.correct {
    background: #cc6699;
}
#card8.correct {
    background: #c6538c;
}
#card9.correct {
    background: #bf4080;
}
#card10.correct {
    background: #ac3973;
}


/* "You did it!" message */
#successMessage {
    position: absolute;
    left: 580px;
    top: 250px;
    width: 0;
    height: 0;
    z-index: 100;
    background: #dfd;
    border: 2px solid #333;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    -moz-box-shadow: .3em .3em .5em rgba(0, 0, 0, .8);
    -webkit-box-shadow: .3em .3em .5em rgba(0, 0, 0, .8);
    box-shadow: .3em .3em .5em rgba(0, 0, 0, .8);
    padding: 20px;
}
</style>

<body>
    <!-- partial:index.partial.html -->
    <div id="content">
        <div id="cardPile"></div>
        <div id="cardSlots"></div>

        <div id="successMessage">
            <h2>You won this!</h2>
            <button onclick="init()">Play Again ?</button>
        </div>
    </div>
    <!-- partial -->
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'></script>
    <script src="./script.js"></script>
    <script>
    var correctCards = 0;
    $(init);

    function init() {

        // Hide the success message
        $('#successMessage').hide();
        $('#successMessage').css({
            left: '580px',
            top: '250px',
            width: 0,
            height: 0
        });

        // Reset the game
        correctCards = 0;
        $('#cardPile').html('');
        $('#cardSlots').html('');

        // Create the pile of shuffled cards
        var numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        numbers.sort(function() {
            return Math.random() - .5
        });

        for (var i = 0; i < 10; i++) {
            $('<div>' + numbers[i] + '</div>').data('number', numbers[i]).attr('id', 'card' + numbers[i]).appendTo(
                '#cardPile').draggable({
                containment: '#content',
                stack: '#cardPile div',
                cursor: 'move',
                revert: true
            });
        }

        // Create the card slots
        var words = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];
        for (var i = 1; i <= 10; i++) {
            $('<div>' + words[i - 1] + '</div>').data('number', i).appendTo('#cardSlots').droppable({
                accept: '#cardPile div',
                hoverClass: 'hovered',
                drop: handleCardDrop
            });
        }

    }

    function handleCardDrop(event, ui) {

        //Grab the slot number and card number
        var slotNumber = $(this).data('number');
        var cardNumber = ui.draggable.data('number');

        //If the cards was dropped to the correct slot,
        //change the card colour, position it directly
        //on top of the slot and prevent it being dragged again
        if (slotNumber === cardNumber) {
            ui.draggable.addClass('correct');
            ui.draggable.draggable('disable');
            $(this).droppable('disable');
            ui.draggable.position({
                of: $(this),
                my: 'left top',
                at: 'left top'
            });
            //This prevents the card from being
            //pulled back to its initial position
            //once it has been dropped
            ui.draggable.draggable('option', 'revert', false);
            correctCards++; //increment keep track correct cards
        }

        //If all the cards have been placed correctly then
        //display a message and reset the cards for
        //another go
        if (correctCards === 10) {
            $('#successMessage').show();
            $('#successMessage').animate({
                left: '380px',
                top: '200px',
                width: '400px',
                height: '150px',
                opacity: 1
            });
        }



    }
    </script>
</body>

</html>