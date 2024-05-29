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
        case "Vakafspraak bekijken": return "View agreement";
        case "Profiel bekijken": return "View profile";
        case "Profiel van ": return "View profile of ";
        case " bekijken": return "";
        case "Sorteren": return "Sort";
        case "Filteren": return "Filter";
        case "Menu": return "Menu";
        case "Uitloggen": return "Log Out";
        case "Instellingen": return "Settings";
        case "Kopiëren": return "Copy";
        case "Er is iets fout gegaan bij het wijzigen van de taal. Check je internetverbinding en probeer het nog eens.": return "Something went wrong while changing the language. Check your internet connection and try again.";

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
