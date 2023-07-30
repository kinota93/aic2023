# html5 validation, form elements
## input type
 `["color", "date", "datetime-local","email","month","number","range","url","week"]`
## attribute
`[required, pattern, maxlength, minlength,max,min,step]`
## css 
`[:required, :optional, :valid, :invalid]`
## js 
`.checkValidality()`, `.setCustomValidality()`

# jquery validation: jquery.validate.js
`<script src="/js/jquery.min.js"></script>`
`<script src="/js/jquery.validate.min.js"></script>`
`validate()` function:
```
('form').validate({
    rules: {
        //ルールの設定
    },
    messages: {
        //エラーメッセージの設定
    },
    
    //エラーメッセージの表示場所を設定
    errorPlacement: function (err, elem) {
        err.appendTo($('p')); //p要素を指定
    }
});

```


```
<form>
    <input name="num" type="checkbox">選択肢１<br>
    <input name="num" type="checkbox">選択肢２<br>
    <input name="num" type="checkbox">選択肢３<br>

    <input type="submit" value="送信">
</form>
<script>
$('form').validate({
        rules: {
            num: {
                required: true, //必須項目にする
                minlength: 2 //2つのチェックが必要
            }
        }
});
</script>
``` 

# boostrap validattion: 
- in `<form>` 
  - `<form class="needs-validation" novalidate>`, `.needs-validation` activates bs validattion AFTER submission, and `novalidate` stops html5 validation
  - `<form class="was-validated">`, activates bs validation BEFORE submission 
- supprted elements
  - `<input>`, `<textarea>` with `.form-control`
  - `<select>`, with `.form-select` 
  - `.form-check-input`  
- indicate valid or invalid form fields
  - `.is-valid`, `.is-invalid`, change them based on server-side validation
- feedback message
  - `<div calss="valid-feedback">...</div>`
  - `<div calss="invalid-feedback">...</div>`
- 
```
<form class="row g-3 needs-validation" novalidate>
  <div class="col-md-4">
    <label for="validationCustom01" class="form-label">First name</label>
    <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-3">
    <label for="validationCustom04" class="form-label">State</label>
    <select class="form-select" id="validationCustom04" required>
      <option selected disabled value="">Choose...</option>
      <option>...</option>
    </select>
    <div class="invalid-feedback">
      Please select a valid state.
    </div>
  </div>
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Submit form</button>
  </div>
</form>
```