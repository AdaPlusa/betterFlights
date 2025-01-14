const lotObieStrony = document.getElementById('lot-obie-strony');
const lotJednaStrona = document.getElementById('lot-jedna-strona');
const polePowrot = document.getElementById('powrot');

lotObieStrony.addEventListener('click', () => {
    polePowrot.disabled = false; // Pole „Powrót” jest aktywne
    lotObieStrony.classList.add('aktywny'); // Dodaj klasę aktywną do przycisku
    lotJednaStrona.classList.remove('aktywny'); // Usuń klasę aktywną z drugiego przycisku
});

lotJednaStrona.addEventListener('click', () => {
    polePowrot.disabled = true; // Pole „Powrót” jest wyłączone
    lotJednaStrona.classList.add('aktywny'); // Dodaj klasę aktywną do przycisku
    lotObieStrony.classList.remove('aktywny'); // Usuń klasę aktywną z drugiego przycisku
});

// ---------------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', () => {
    const minus = document.getElementById('minus');
    const plus = document.getElementById('plus');
    const input = document.getElementById('pasazerowie');

    // Minimalna i maksymalna liczba pasażerów
    const min = parseInt(input.min);
    const max = parseInt(input.max);

    // Obsługa przycisku "-"
    minus.addEventListener('click', () => {
        const currentValue = parseInt(input.value);
        if (currentValue > min) {
            input.value = currentValue - 1;
        }
        toggleButtons();
    });

    // Obsługa przycisku "+"
    plus.addEventListener('click', () => {
        const currentValue = parseInt(input.value);
        if (currentValue < max) {
            input.value = currentValue + 1;
        }
        toggleButtons();
    });

    // Włącz/wyłącz przyciski w zależności od wartości
    function toggleButtons() {
        minus.disabled = parseInt(input.value) <= min;
        plus.disabled = parseInt(input.value) >= max;
    }

    // Inicjalizacja stanu przycisków
    toggleButtons();
});

// ---------------------------------------------------------------------------
//zakladki
const zakladki = document.querySelectorAll('.zakladka');

zakladki.forEach(zakladka => {
    zakladka.addEventListener('click', () => {
        // Usuń klasę "aktywna" ze wszystkich zakładek
        zakladki.forEach(z => z.classList.remove('aktywna'));

        // Dodaj klasę "aktywna" do klikniętej zakładki
        zakladka.classList.add('aktywna');
    });
});

// ---------------------------------------------------------------------------
// pobieranie miast z baz danych
