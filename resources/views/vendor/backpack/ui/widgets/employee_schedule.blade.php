{{-- Include widget wrapper --}}
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')

<h2>
    Расписание
</h2>

<form action="" method="GET">
    <div class="row form-group">
        <div class="form-group col-md-3">
            <label for="date"><strong>Выберите дату</strong></label>
            <input type="date" class="form-control" name="date" id="date">
        </div>

        <div class="form-group col-md-2">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-info form-control">
                Показать расписание
            </button>
        </div>
    </div>
</form>

@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')
