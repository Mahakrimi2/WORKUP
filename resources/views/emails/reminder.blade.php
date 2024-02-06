<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Albaraka</title>
  <style>
/*
 * TICKET
 * ---------------------------------------------
 */

 .ticket-wrap {
text-align: center;
}

.ticket {
display: inline-block;
margin: 0 auto;
border: 2px solid #9facbc;
font-family: "Variable Bahnschrift", "FF DIN", "Franklin Gothic", "Helvetica Neue", sans-serif;
font-feature-settings: "kern" 1;
background: #fff;
}

.ticket__header {
margin: 0;
padding: 1.5em;
background: #f4f5f6;
}

.ticket__co span,
.ticket__route span {
display: block;
}

.ticket__co {
display: inline-block;
position: relative;
padding-left: 5em;
line-height: 1;
color: #5e7186;
}

.ticket__co-icon {
position: absolute;
top: 50%;
margin-top: -2em;
left: 0;
width: 4em;
height: auto;
}

.ticket__co-name {
font-size: 2.5em;
font-variation-settings: "wght" 500, "wdth" 75;
letter-spacing: -.01em;
}

.ticket__co-subname {
font-variation-settings: "wght" 700;
color: #506072;
}

.ticket__body {
padding: 2rem 1.25em 1.25em;
}

.ticket__route {
font-variation-settings: "wght" 300;
font-size: 2em;
line-height: 1.1;
}

.ticket__description {
margin-top: .5em;
font-variation-settings: "wght" 350;
font-size: 1.125em;
color: #506072;
}

.ticket__timing {
display: flex;
align-items: center;
margin-top: 1rem;
padding: 1rem 0;
border-top: 2px solid #9facbc;
border-bottom: 2px solid #9facbc;
text-align: left;
}

.ticket__timing p {
margin: 0 1rem 0 0;
padding-right: 1rem;
border-right: 2px solid #9facbc;
line-height: 1;
}

.ticket__timing p:last-child {
margin: 0;
padding: 0;
border-right: 0;
}

.ticket__small-label {
display: block;
margin-bottom: .5em;
font-variation-settings: "wght" 300;
font-size: .875em;
color: #506072;
}

.ticket__detail {
font-variation-settings: "wght" 700;
font-size: 1.25em;
color: #424f5e;
}

.ticket__admit {
margin-top: 2rem;
font-size: 2.5em;
font-variation-settings: "wght" 700, "wdth" 85;
line-height: 1;
color: #657990;
}

.ticket__fine-print {
margin-top: 1rem;
font-variation-settings: "wdth" 75;
color: #666;
}

.ticket__barcode {
margin-top: 1.25em;
width: 299px;
max-width: 100%;
}

@media (min-width: 36em) {
.ticket-wrap {
margin-bottom: 4em;
text-align: center;
}

.ticket {
margin: 0 auto;
transform: rotate(6deg);
}

.ticket__header {
margin: 0;
padding: 2em;
}

.ticket__body {
padding: 3rem 2em 2em;
}

.ticket__detail {
font-size: 1.75em;
}

.ticket__admit {
margin-top: 2rem;
}
}

@supports (display:grid) {
@media (min-width: 72em) {
.ticket-info,
.ticket-wrap {
align-self: center;
}

.ticket-wrap {
order: 2;
margin-bottom: 0;
}

.ticket-info {
order: 1;
}
}
}
  </style>
  <link rel="stylesheet" href="https://az813057.vo.msecnd.net/testdrive/var-fonts/font-declarations.css">
</head>
<body>
<!-- partial:index.partial.html -->
<div class="l-col-right ticket-wrap" aria-label="A fake boat ticket demonstrating mixing font weights and widths">
  <div class="ticket" aria-hidden="true">
    <div class="ticket__header">
      <div class="ticket__co">
        <span class="ticket__co-name">workup</span>
        <span class="u-upper ticket__co-subname">Book</span>
      </div>
    </div>


      <div class="ticket__timing">
        <p class="ticket__fine-print">Room name:</p>
        <p class="u-upper ticket__admit">{{$salle}}</p>

      </div>
      <div class="ticket__timing">
        <p class="ticket__fine-print">Date:</p>
        <p class="u-upper ticket__admit">{{$date}}</p>

      </div>
      <div class="ticket__timing">
        <p class="ticket__fine-print">Start time:</p>
        <p class="u-upper ticket__admit">{{$time_start}}</p>

      </div>
      <div class="ticket__timing">
        <p class="ticket__fine-print">End time:</p>
        <p class="u-upper ticket__admit">{{$time_end}}</p>
      </div>
    </div>
  </div>
</div>
</body>
</html>
