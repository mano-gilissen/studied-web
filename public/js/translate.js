function translated(value) {

    switch (lang) {

        case "en":
            return translateEn(value);

        case "nl_NL":
            return translateNl(value);

        default:
            return value;
    }
}



function translateEn(value) {

    switch (value) {

        case "": return "";
        "Vakafspraak bekijken"
        "Profiel bekijken"
        "Profiel van "
        " bekijken"
        "Sorteren"
        "Filteren"
        "Menu"
        "Uitloggen"
        "Instellingen"
        "Kopiëren"
        "Er is iets fout gegaan bij het wijzigen van de taal. Check je internetverbinding en probeer het nog eens."

        default:
            return value;
    }
}



function translateNl(value) {

    switch (value) {

        default:
            return value;
    }
}
