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
        case "Weet je zeker dat je dit rapport en de bijhorende les wilt verwijderen? Dit kan niet ongedaan worden gemaakt.": return "Are you sure you want to delete this report and the associated lesson? This cannot be undone.";
        case "Het rapport is gemarkeerd als afgekeurd.": return "The report has been marked as rejected.";
        case "Het rapport is nu niet meer gemarkeerd als afgekeurd.": return "The report is no longer marked as rejected.";
        case "Door rapporteren te verlengen kan deze les weer 24 uur gerapporteerd worden door de student-docent. Weet je zeker dat je rapporteren wil verlengen?": return "By extending reporting, this lesson can be reported again by the student-teacher for another 24 hours. Are you sure you want to extend reporting?";
        case "Rapporteren is nu verlengd. De student-docent kan deze les de komende 24 uur weer rapporteren.": return "Reporting has been extended. The student-teacher can report this lesson again for the next 24 hours.";

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
