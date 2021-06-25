import {Controller} from 'stimulus';
import {v4 as uuidv4} from 'uuid';

export default class extends Controller {
    prototype;

    connect() {
        this.label = this.element.dataset['label']||'';

        for (const $fieldset of this.element.querySelectorAll('fieldset')) {
            this.addRemoveButton($fieldset);
            $fieldset.querySelector('legend').innerText = this.label;
        }

        this.prototype = this.element.dataset['prototype'];


        this.name = this.element.dataset['name'];
        this.$buttonAdd = document.createElement('button');
        this.$buttonAdd.innerText = 'Ajouter une '+ this.name;
        this.$buttonAdd.classList.add('btn');
        this.$buttonAdd.classList.add('btn-info');
        this.$buttonAdd.setAttribute('type', 'button');

        this.$buttonAdd.addEventListener('click', (e) => {
            e.preventDefault();
            this.addField();
        });

        this.element.append(this.$buttonAdd);

        if (this.element.hasAttribute('data-addField')) {
            this.addField();
        }
    }

    addField() {
        const $div = document.createElement('div');
        $div.innerHTML = this.prototype
            .replace(/__name__label__/g, this.label)
            .replace(/__name__/g, uuidv4());

        const $field = $div.firstChild;

        this.addRemoveButton($field);

        this.element.insertBefore($field, this.$buttonAdd);
    }

    addRemoveButton($field) {
        const $buttonRemove = document.createElement('button');
        $buttonRemove.innerText = 'Supprimer ' + this.name;
        $buttonRemove.classList.add('btn');
        $buttonRemove.classList.add('btn-danger');
        $buttonRemove.setAttribute('type', 'button');

        $buttonRemove.addEventListener('click', (e) => {
            e.preventDefault();
            $field.remove();
        });

        $field.append($buttonRemove);
    }
}
