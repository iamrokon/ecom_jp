<script>
function generateChildCategory(firstTime = false, childID = null)
{
    let parent = document.getElementById('parent_category').value;
    let categories = @json($categories);
    var select = document.getElementById("child_category");
    select.options.length = 0;
    select.options[select.options.length] = new Option('-','');
    for(var field in categories[parent])
    {
        let child = categories[parent][field];
        select.options[select.options.length] = new Option(child['zokusei'],child['bango']);
        if(firstTime && child['bango']==childID)
        {
            select.selectedIndex = select.options.length-1;
        }
    }
}
function mainFormHandler(reload = 'samePage')
{
    document.getElementById('mainFormButton').disabled = true;
    let csrf = '{{ csrf_token() }}';
    let xhr = new XMLHttpRequest();
    let route = document.getElementById('mainForm').action;
    xhr.open("POST",route,true);
    xhr.onload = function(event)
    {
        var response = event.target.response;

        if(response.substring(0, 2) === 'ok')
        {
            if(reload === 'goToIndex') window.location.replace('{{ route('admin.products.index') }}');
            else window.location.reload(true);
        }
        else
        {
            clearError();
            var errors = JSON.parse(response);
            let ul = document.createElement('UL');
            let isfocused = false;
            for (var field in errors)
            {
                if(errors[field][0]!=='')
                {
                    let li = document.createElement('LI');
                    li.innerText = errors[field][0];
                    ul.appendChild(li);
                }
                if(document.getElementById("mainForm").elements.namedItem(field))
                {
                    if(field=='main_image') document.getElementById('main-image-box').classList.add('form-error');
                    else if(!(['store_flag','display_flag','recommendation'].includes(field))) document.getElementById("mainForm").elements.namedItem(field).classList.add('form-error');
                    if(!isfocused && !['store_flag','display_flag','recommendation'].includes(field))
                    {
                        document.getElementById("mainForm").elements.namedItem(field).focus();
                        document.getElementById("mainForm").elements.namedItem(field).scrollIntoView();
                        isfocused = true;
                    }
                }
            }
            document.getElementById('error_list').appendChild(ul);
            document.getElementById('mainFormButton').disabled = false;

            if(document.getElementById('success_list'))
            {
                document.getElementById('success_list').style.display = "none";
            }
        }
    };
    let formData = new FormData(document.getElementById("mainForm"));
    xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
    xhr.send(formData);
}
function photosPreview()
{
    let csrf = '{{ csrf_token() }}';
    let xhr = new XMLHttpRequest();
    let route = document.getElementById('photosForm').action;
    xhr.open("POST",route,true);
    xhr.onload = function(event)
    {
        clearError();
        var response = event.target.response;
        if(response.substring(0, 2) === 'NG')
        {
            var errors = response.replace('NG||','').split("||");
            showPhotosErrors(errors);
            window.scrollTo(0, 0);
        }
        else
        {
            let paths = JSON.parse(response);
            let text = document.getElementById('photo_list').value;
            for (let key in paths) {
                text = text + paths[key] + '||';
            }
            document.getElementById('photo_list').value = text;
            showPreview();
        }
        enableFile();
    };
    let formData = new FormData(document.getElementById("photosForm"));
    xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
    xhr.send(formData);
    disableFile();
}

function showPreview()
{
    document.getElementById('frames').innerHTML = '';
    var paths = document.getElementById('photo_list').value.split("||");
    var photoCount = 0;

    let temp = document.createElement("DIV");
    temp.className = "col-lg-2 col-md-3";
    document.getElementById("frames").appendChild(temp);

    let mainDiv = document.createElement("DIV");
    mainDiv.className = "col-lg-10 col-md-9";

    let subDiv = document.createElement("DIV");
    subDiv.className = "payment-method-item";

    let flex = document.createElement("DIV");
    flex.className = "payment-method-header d-flex flex-wrap";

    for(var i = 0; i<paths.length; i++)
    {
        if(paths[i])
        {
            let thumb = document.createElement("DIV");
            thumb.className = "thumb";

            let preview = document.createElement("DIV");
            preview.className = "avatar-preview";

            let img = document.createElement("DIV");
            img.className = "profilePicPreview";
            img.setAttribute("style", "background-image: url('"+'{{ route('homepage') }}' + '/storage/product/images/' + paths[i]+"')");

            preview.appendChild(img);
            thumb.appendChild(preview);

            let edit = document.createElement("DIV");
            edit.className = "avatar-edit";

            let label = document.createElement("LABEL");
            label.className = "bg--primary";

            let link = document.createElement("A");
            link.setAttribute("onclick", "deleteFromPreview('"+paths[i]+"')");

            let icon = document.createElement("I");
            icon.className = "la la-trash";

            label.appendChild(icon);
            link.appendChild(label);
            edit.appendChild(link);
            thumb.appendChild(edit);

            flex.appendChild(thumb);

            photoCount++;
        }
    }
    subDiv.appendChild(flex);
    mainDiv.appendChild(subDiv);
    document.getElementById("frames").appendChild(mainDiv);

    document.getElementById("uploadedImageNumber").value = photoCount;
}

function deleteFromPreview(img)
{
    let text = document.getElementById('photo_list').value;
    document.getElementById('photo_list').value = text.replace( img +'||' , '');
    showPreview();
}

function showPhotosErrors(errors)
{
    var ul = document.createElement("UL");
    ul.classList.add("alert-list");
    for(let i = 0; i<errors.length; i++)
    {
        if(errors[i])
        {
            let li = document.createElement("LI");
            li.innerHTML = errors[i];
            ul.appendChild(li);
        }
    }
    document.getElementById('error_list').appendChild(ul);
}

function clearError()
{
    document.getElementById('error_list').innerHTML = '';
    if(document.getElementById('success_list'))
    {
        document.getElementById('success_list').innerHTML = '';
    }

    let elements = document.forms["mainForm"].elements;
    
    for (i=0; i<elements.length; i++)
    {
        elements[i].classList.remove('form-error');
    }
    document.getElementById('main-image-box').classList.remove('form-error');
}
function disableFile()
{
    document.getElementById('photosFileLabel').classList.add('disabled');
    document.getElementById('photosFileSelector').disabled = true;
    document.getElementById('photosFileSelectorSpinner').classList.remove('d-none');
}
function enableFile()
{
    document.getElementById('photosFileLabel').classList.remove('disabled');
    document.getElementById('photosFileSelector').disabled = false;
    document.getElementById('photosFileSelectorSpinner').classList.add('d-none');
}
</script>