(function() {
    const element = document.getElementById('type');
    if (element == undefined) {
        return;
    }
    element.addEventListener('change', updateForm);

    function updateForm(e) {
        switch (e.target.value) {
            case 'MX':
                resetToDefault();
                addMxFields();
                break;
            case 'SRV':
                resetToDefault();
                addSrvFields();
                break;
            default:
                resetToDefault();
                break;
        }
    };

    function resetToDefault() {
        let nodes = document.getElementsByClassName('generated');
        while (nodes.length > 0) {
            nodes[0].remove();
        }
    }

    function addSrvFields() {

        var container = document.getElementById("addRecord");

        const wrapper = document.createElement('div');
        wrapper.classList.add('form-group');
        wrapper.classList.add('generated');
        const label = document.createElement('label');
        label.setAttribute('for', 'prio');
        label.innerText = "Prio";

        const input = document.createElement("input");
        input.type = "text";
        input.name = "prio";
        input.id = "prio";
        input.setAttribute('required', 'true');
        input.classList.add('form-control');
        input.setAttribute('placeholder', 'Add prio');

        wrapper.appendChild(label);
        wrapper.appendChild(input);
        const button = document.getElementById('submit');
        container.insertBefore(wrapper, button);

        const wrapper2 = document.createElement('div');
        wrapper2.classList.add('form-group');
        wrapper2.classList.add('generated');
        const label2 = document.createElement('label');
        label2.setAttribute('for', 'port');
        label2.innerText = "Port";

        const input2 = document.createElement("input");
        input2.type = "text";
        input2.id = "port";
        input2.name = "port";
        input2.setAttribute('required', 'true');
        input2.classList.add('form-control');
        input2.setAttribute('placeholder', 'Add port');

        wrapper2.appendChild(label2);
        wrapper2.appendChild(input2);
        container.insertBefore(wrapper2, button);

        const wrapper3 = document.createElement('div');
        wrapper3.classList.add('form-group');
        wrapper3.classList.add('generated');
        const label3 = document.createElement('label');
        label3.setAttribute('for', 'weight');
        label3.innerText = "Weight";

        const input3 = document.createElement("input");
        input3.type = "text";
        input3.id = "weight";
        input3.name = "weight";
        input3.setAttribute('required', 'true');
        input3.classList.add('form-control');
        input3.setAttribute('placeholder', 'Add weight');

        wrapper3.appendChild(label3);
        wrapper3.appendChild(input3);
        container.insertBefore(wrapper3, button);
    }

    function addMxFields() {

        var container = document.getElementById("addRecord");

        const wrapper = document.createElement('div');
        wrapper.classList.add('form-group');
        wrapper.classList.add('generated');
        const label = document.createElement('label');
        label.setAttribute('for', 'prio');
        label.innerText = "Prio";

        const input = document.createElement("input");
        input.type = "text";
        input.id = "prio";
        input.setAttribute('required', 'true');
        input.name = "prio";
        input.classList.add('form-control');
        input.setAttribute('placeholder', 'Add prio');

        wrapper.appendChild(label);
        wrapper.appendChild(input);
        const button = document.getElementById('submit');
        container.insertBefore(wrapper, button);
    }
})();