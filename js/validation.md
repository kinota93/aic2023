# form validation
- html5 validation
- jquery.validate.js
- parsley.js
- bootstrap validation

## 1. html5 validation, form elements
### input type
 `["color", "date", "datetime-local","email","month","number","range","url","week"]`
### attribute
`[required, pattern, maxlength, minlength,max,min,step]`
### css 
`[:required, :optional, :valid, :invalid]`
### js 
`.checkValidality()`, `.setCustomValidality()`

## 2. jquery.validate.js
`<script src="/js/jquery.min.js"></script>`
`<script src="/js/jquery.validate.min.js"></script>`
`validate()`:
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

## 3. Parsley.js

A validator is a method to determine if a given value (or sometimes sets of values) is acceptable or not, given some requirement parameters.

Parsley comes with many builtin validators and provides tools to specify your own.

### Validators and Directives
- `.parsley().on("event", function(){...})`, event, e.g., `field:validated`
- `.parsley().addValidator()`
```
.parsley().addValidator(
  'name', 
  {
    validate[Number|String|Date|Multiple]: function(){...return bool value;},
    requirementType: 'integer'|'number'|'string'|'date'|'regexp'|'boolean'|['integer','integer'] #range,
    messages: {en: 'English message', ja: '日本語メッセージ'},
  });
```
- html5 validation, `type="email"`,`required=""`, etc.
- `data-parsley-validate`, directive in `<form>` element
- `data-parsley-trigger="event"`, event such as change, click, keyup
- `data-parsley-length="[n, m]"`, for `<input type="text">`
- `data-parsley-group="goup1">` , validate a group of elements
- `data-parsley-mincheck="n">`, directive in `<input type="checkbox">`
- `data-parsley-minlength="n"`, `data-parsley-maxlength="m"`, for `<textarea>`
- `data-parsley-minlength-message="..."`, `data-parsley-maxlength-message="..."`
- `data-parsley-validation-threshold="n"`

```
<div class="bs-callout bs-callout-warning hidden">
  <h4>Oh snap!</h4>
  <p>This form seems to be invalid :(</p>
</div>

<div class="bs-callout bs-callout-info hidden">
  <h4>Yay!</h4>
  <p>Everything seems to be ok :)</p>
</div>

<form id="demo-form" data-parsley-validate="">
  <label for="fullname">Full Name * :</label>
  <input type="text" class="form-control" name="fullname" required="">

  <label for="email">Email * :</label>
  <input type="email" class="form-control" name="email" data-parsley-trigger="change" required="">

  <label for="contactMethod">Preferred Contact Method *:</label>
  <p>
    Email: <input type="radio" name="contactMethod" id="contactMethodEmail" value="Email" required="">
    Phone: <input type="radio" name="contactMethod" id="contactMethodPhone" value="Phone">
  </p>

  <label for="hobbies">Hobbies (Optional, but 2 minimum):</label>
  <p>
    Skiing <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2"><br>
    Running <input type="checkbox" name="hobbies[]" id="hobby2" value="run"><br>
    Eating <input type="checkbox" name="hobbies[]" id="hobby3" value="eat"><br>
    Sleeping <input type="checkbox" name="hobbies[]" id="hobby4" value="sleep"><br>
    Reading <input type="checkbox" name="hobbies[]" id="hobby5" value="read"><br>
    Coding <input type="checkbox" name="hobbies[]" id="hobby6" value="code"><br>
  </p>

  <p>
  <label for="heard">Heard about us via *:</label>
  <select id="heard" required="">
    <option value="">Choose..</option>
    <option value="press">Press</option>
    <option value="net">Internet</option>
    <option value="mouth">Word of mouth</option>
    <option value="other">Other..</option>
  </select>
  </p>

  <p>
  <label for="message">Message (20 chars min, 100 max) :</label>
  <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10"></textarea>
  </p>

  <br>
  <input type="submit" class="btn btn-default" value="validate">

  <p><small>* Please, note that this demo form is not a perfect example of UX-awareness. The aim here is to show a quick overview of parsley-API and Parsley customizable behavior.</small></p>
</form>

<script type="text/javascript">
$(function () {
  $('#demo-form').parsley().on('field:validated', function() {
    var ok = $('.parsley-error').length === 0;
    $('.bs-callout-info').toggleClass('hidden', !ok);
    $('.bs-callout-warning').toggleClass('hidden', ok);
  })
  .on('form:submit', function() {
    return false; // Don't submit form for this demo
  });
});
</script>

```

### `Promise` and `Deferred` Objects 

In JavaScript and JQuery

#### jqXHR

As of jQuery 1.5, the `$.ajax()` method returns the `jqXHR` object, which is a superset of the XMLHTTPRequest object. For more information, see the jqXHR section of the $.ajax entry

#### Thenable

Any object that has a then method.

#### Deferred Object

As of jQuery 1.5, the Deferred object provides a way to register multiple callbacks into self-managed callback queues, invoke callback queues as appropriate, and relay the success or failure state of any synchronous or asynchronous function.


#### Promise Object

This object provides a subset of the methods of the Deferred object (`then`, `done`, `fail`, `always`, `pipe`, `progress`, `state` and `promise`) to prevent users from changing the state of the Deferred.


## 4. boostrap validattion: 
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