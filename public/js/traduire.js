document.addEventListener("DOMContentLoaded", () => {
  // Sélectionnez les champs de formulaire nécessaires
  let frNameInput = document.querySelector("#Pays_fr_name");
  let enNameInput = document.querySelector("#Pays_en_name");
  let esNameInput = document.querySelector("#Pays_es_name");
  if (!frNameInput || !enNameInput || !esNameInput) {
    frNameInput = document.querySelector("#Club_fr_name");
    enNameInput = document.querySelector("#Club_en_name");
    esNameInput = document.querySelector("#Club_es_name");
  }
  const customButton = document.createElement("button");
  customButton.textContent = "Traduire ";
  customButton.classList.add("btn", "btn-info"); // Utilisez les classes de Tailwind pour la mise en forme

  // Créez l'icône FontAwesome
  const icon = document.createElement("i");
  icon.classList.add("fas", "fa-language");

  // Ajoutez l'icône à votre bouton
  customButton.appendChild(icon);
  // Fonction pour traduire le texte avec l'API de MyMemory
  async function translateTextMyMemory(text, sourceLanguage, targetLanguage) {
    console.log("text", text);
    const response = await fetch(
      `https://api.mymemory.translated.net/get?q=${encodeURIComponent(
        text
      )}&langpair=${sourceLanguage}|${targetLanguage}`,
      {
        method: "GET",
      }
    );
    const data = await response.json();
    return data.responseData.translatedText;
  }

  // Fonction pour mettre à jour les valeurs des champs en anglais et en espagnol
  async function updateText() {
    const frText = frNameInput.value;

    // Traduire en anglais
    let enText = await translateTextMyMemory(frText, "fr", "en");

    // Met tout le texte en minuscules
    enText = enText.toLowerCase();
    // Capitalise la première lettre de chaque mot
    let textCapitalized = enText.replace(/\b\w/g, function (char) {
      return char.toUpperCase();
    });
    enNameInput.value = textCapitalized;

    // Traduire en espagnol
    let esText = await translateTextMyMemory(frText, "fr", "es");
    // Met tout le texte en minuscules
    esText = esText.toLowerCase();
    // Capitalise la première lettre de chaque mot
    textCapitalized = esText.replace(/\b\w/g, function (char) {
      return char.toUpperCase();
    });
    esNameInput.value = textCapitalized;
  }

  // Fonction pour activer/désactiver le bouton en fonction de la valeur de l'input en français
  const toggleButton = () => {
    customButton.disabled = frNameInput.value.trim() === "";
  };

  // Ajoutez un événement de clic au bouton
  customButton.addEventListener("click", () => {
    updateText();
  });

  if (frNameInput) {
    // Ajoutez un écouteur d'événement pour le champ de saisie en français
    frNameInput.addEventListener("input", () => {
      toggleButton();
    });

    // Désactivez initialement le bouton si le champ en français est vide
    toggleButton();

    // Sélectionnez l'élément où vous souhaitez ajouter le bouton
    const pageActionsDiv = document.querySelector(".page-actions");

    // Ajoutez le bouton supplémentaire au début de l'élément cible
    pageActionsDiv.insertBefore(customButton, pageActionsDiv.firstChild);
  }
  //#######################################################################################################################
  // Crée un span pour afficher la couleur sélectionnée
  var selectedColorSpan = document.createElement("span");
  selectedColorSpan.id = "selectedColor";
  selectedColorSpan.className = "selected-color";
  selectedColorSpan.style.backgroundColor = "transparent";
  selectedColorSpan.style.width = "300px";
  selectedColorSpan.style.height = "20px";
  selectedColorSpan.style.display = "none"; // Démarre caché

  // Ajoute le span à la suite du select
  var select = document.getElementById("Club_colorPrimary");
  if (select) {
    select.parentNode.appendChild(selectedColorSpan);

    // Récupère l'option sélectionnée au chargement de la page
    var selectedOption =
      document.getElementById("Club_colorPrimary").options[
        document.getElementById("Club_colorPrimary").selectedIndex
      ];
    var selectedColor = document.getElementById("selectedColor");
    // Définit la couleur de fond du carré en fonction de l'option sélectionnée au chargement
    if (selectedOption.value !== "") {
      selectedColor.style.backgroundColor =
        selectedOption.innerText.toLowerCase();
      selectedColor.style.display = "inline-block";
    } else {
      selectedColor.style.backgroundColor = "transparent";
      selectedColor.style.display = "none";
    }
  }

  // Crée un span pour afficher la couleur sélectionnée
  var selectedColorSpan2 = document.createElement("span");
  selectedColorSpan2.id = "selectedColor2";
  selectedColorSpan2.className = "selected-color";
  selectedColorSpan2.style.width = "300px";
  selectedColorSpan2.style.height = "20px";
  selectedColorSpan2.style.display = "none"; // Démarre caché

  // Ajoute le span à la suite du select
  var select = document.getElementById("Club_colorSecondary");
  if (select) {
    select.parentNode.appendChild(selectedColorSpan2);
    // Récupère l'option sélectionnée au chargement de la page
    var selectedOption = document.getElementById("Club_colorSecondary").options[
      document.getElementById("Club_colorSecondary").selectedIndex
    ];
    var selectedColor = document.getElementById("selectedColor2");

    // Définit la couleur de fond du carré en fonction de l'option sélectionnée au chargement
    if (selectedOption.value !== "") {
      selectedColor.style.backgroundColor =
        selectedOption.innerText.toLowerCase();
      selectedColor.style.display = "inline-block";
    } else {
      selectedColor.style.backgroundColor = "transparent";
      selectedColor.style.display = "none";
    }
  }
});

const element = document.getElementById("Club_colorPrimary");
if (element) {
  // Fonction pour mettre à jour le carré de couleur lorsque l'option est sélectionnée
  element.addEventListener("change", function () {
    var selectedOption = this.options[this.selectedIndex];
    var selectedColor = document.getElementById("selectedColor");

    if (selectedOption.value !== "") {
      selectedColor.style.backgroundColor =
        selectedOption.innerText.toLowerCase();
      selectedColor.style.display = "inline-block";
    } else {
      selectedColor.style.backgroundColor = "transparent";
      selectedColor.style.display = "inline-block";
    }
  });
}
const elementSecondary = document.getElementById("Club_colorSecondary");
if (elementSecondary) {
  // Fonction pour mettre à jour le carré de couleur lorsque l'option est sélectionnée
  elementSecondary.addEventListener("change", function () {
    var selectedOption = this.options[this.selectedIndex];
    var selectedColor = document.getElementById("selectedColor2");

    if (selectedOption.value !== "") {
      selectedColor.style.backgroundColor =
        selectedOption.innerText.toLowerCase();
      selectedColor.style.display = "inline-block";
    } else {
      selectedColor.style.backgroundColor = "transparent";
      selectedColor.style.display = "inline-block";
    }
  });
}
