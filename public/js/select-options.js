//Selections:
const typeSelect = document.getElementById('type');
const makeSelect = document.getElementById('make');
const modelSelect = document.getElementById('model');

//Ecouteur en selectionement
typeSelect.addEventListener('change', updateModelOptions);
makeSelect.addEventListener('change', updateModelOptions);

//fonctione pour mettre a jour la modele en dependence du type est la marque

function updateModelOptions() {
    const selectedType = typeSelect.value;
    const selectedMake = makeSelect.value;

    //Parcourir chaque option
    for (let i = 0; i < modelSelect.options.length; i++){
        const option = modelSelect.options[i];
        const optionMake = option.getAttribute('data-make');
        const optionType = option.getAttribute('data-type');

        //Verification si l'option coresponds avec le type et la modele
        if((optionMake === selectedMake || selectedMake === '') && (optionType === selectedType || selectedType === '')) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    }

    //reseter la modele selectione quand le type ou la modele change
    modelSelect.selectedIndex = 0;
}
