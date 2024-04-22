document.addEventListener("DOMContentLoaded", () => {
  //#######################################################################################################################
  // CREATION D'UN BOUTON POUR TRADUIRE LE TEXTE
  const element = document.getElementById("Question_en_question");
  if (element) {
    const translateButton = document.createElement("button");
    translateButton.textContent = "Traduire ";
    translateButton.classList.add("btn", "btn-info"); // Utilisez les classes de Tailwind pour la mise en forme
    // Créez l'icône FontAwesome
    const icon = document.createElement("i");
    icon.classList.add("fas", "fa-language");
    // Ajoutez l'icône à votre bouton
    translateButton.appendChild(icon);
    // Sélectionnez l'élément où vous souhaitez ajouter le bouton
    const pageActionsDiv = document.querySelector(".page-actions");
    // Ajoutez le bouton supplémentaire au début de l'élément cible
    pageActionsDiv.insertBefore(translateButton, pageActionsDiv.firstChild);
    //#######################################################################################################################
    // Ajoutez un événement de clic au bouton
    translateButton.addEventListener("click", () => {
      updateText();
    });
  }
  //#######################################################################################################################
  // Fonction pour traduire le texte avec l'API de MyMemory
  async function translateTextMyMemory(text, sourceLanguage, targetLanguage) {
    const response = await fetch(
      `https://api.mymemory.translated.net/get?q=${encodeURIComponent(
        text
      )}&langpair=${sourceLanguage}|${targetLanguage}`,
      {
        method: "GET",
      }
    );
    const data = await response.json();
    console.log("data", data);
    return data.responseData.translatedText;
  }

  // Fonction pour mettre à jour les valeurs des champs en anglais et en espagnol
  async function updateText() {
    // Récupère tous les champs de question en français
    const questionsFr = document.querySelectorAll("[id^='Question_fr']");

    // Parcours chaque champ de question en français
    for (const questionFr of questionsFr) {
      // Récupère l'ID du champ en français
      const id = questionFr.id;

      // Construis les IDs des champs en anglais et en espagnol basés sur l'ID du champ en français
      const idEn = id.replace("fr", "en");
      const idEs = id.replace("fr", "es");

      // Récupère les champs en anglais et en espagnol
      const questionEn = document.getElementById(idEn);
      const questionEs = document.getElementById(idEs);

      // Si les champs en anglais et en espagnol existent, traduis et copie les valeurs du champ en français
      if (questionEn && questionEs) {
        // Traduction simulée (remplace cette partie par l'appel à ton API de traduction)
        const translationEn = await translateTextMyMemory(
          questionFr.value,
          "fr",
          "en"
        );
        const translationEs = await translateTextMyMemory(
          questionFr.value,
          "fr",
          "es"
        );

        // Colle la traduction dans les champs en anglais et en espagnol
        questionEn.value = translationEn;
        questionEs.value = translationEs;
      }
    }
  }
});
