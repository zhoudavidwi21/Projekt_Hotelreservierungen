<?php include "./Commons/sessions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css_Daten/accordion.css">

  <title>Hilfe/FAQs</title>
</head>


<body>

  <?php include "Commons/header.php"; ?>

  <div class="text-center container-fluid">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-6">
        <div class="d-grid gap-3">
          <div class="container-fluid">
            <h1>Hilfe/FAQs</h1>
          </div>
          <div class="container-fluid">
            <h2>Anleitungen:</h2>
          </div>
          <div class="row justify-content-md-center">
            <div class="col-10">
              <div class="accordion" id="accordionAnleitung">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#anleitungOne" aria-expanded="false" aria-controls="anleitungOne">
                      <strong>Wie registriere ich mich?</strong>
                    </button>
                  </h2>
                  <div id="anleitungOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      Wenn Sie noch keinen Account auf unserer Website haben, dann können Sie gerne oben rechts, in der
                      Navigationsleiste, unter dem
                      Link "registrieren" einen Account anlegen.
                      <br>
                      Beachten Sie bitte, dass alle mit * markierten Felder eine Eingabe erfordern.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#anleitungTwo" aria-expanded="false" aria-controls="anleitungTwo">
                      <strong>Wie logge ich mich ein?</strong>
                    </button>
                  </h2>
                  <div id="anleitungTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      Wenn Sie sich bereits einmal bei uns registriert haben, dann können Sie oben rechts, in der
                      Navigationsleiste, unter "anmelden" sich mit Ihrem Benutzernamen und Ihrem Passwort anmelden.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#anleitungThree" aria-expanded="false" aria-controls="anleitungThree">
                      <strong>Wie kann ich ein Zimmer reservieren?</strong>
                    </button>
                  </h2>
                  <div id="anleitungThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      Es können leider nur Nutzer ein Zimmer reservieren, die bei uns bereits registriert sind. Sollten
                      Sie noch nicht registriert sein, können Sie leider keine Zimmer bei uns reservieren.
                      Sollten Sie jedoch bereits angemeldet sein, müssen sie sich einloggen und dann unter dem Reiter
                      Zimmer auf der Navigationsleiste auf "Zimmer reservieren" klicken.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="container-fluid">
            <h2>FAQs:</h2>
          </div>


          <div class="row justify-content-md-center">
            <div class="col-10">
              <div class="accordion" id="accordionFAQs">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#faqsOne" aria-expanded="true" aria-controls="faqsOne">
                      <strong>Kann ich meine Haustiere mitnehmen?</strong>
                    </button>
                  </h2>
                  <div id="faqsOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Sie können gerne Ihr Haustier mitnehmen. Geben Sie dafür einfach bei der Zimmerreservierung an, dass Sie Ihr Haustier mitnehmen.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#faqsTwo" aria-expanded="false" aria-controls="faqsTwo">
                      <strong>Was gibt es in der Nähe?</strong>
                    </button>
                  </h2>
                  <div id="faqsTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      Unser Hotel liegt direkt an der Krems und ist nur 5 Minuten Fußweg von der Donau entfernt. Sie können entlang der Donau Restaurants genießen und sogar eine Schiffsfahrt buchen.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#faqsThree" aria-expanded="false" aria-controls="faqsThree">
                      <strong>Ist ein Frühstück inkludiert?</strong>
                    </button>
                  </h2>
                  <div id="faqsThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Sie können gegen einen Aufpreis ein Frühstück inkludieren lassen.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col">

      </div>
    </div>
  </div>

  <?php include "Commons/footer.php"; ?>

</body>

</html>