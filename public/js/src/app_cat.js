import cat_events from './categoria/events.js';

document.addEventListener('DOMContentLoaded', function(e) {
    const c_events = cat_events();
        //active delete buttons at categories
        c_events.delete_categories();

        //active edit buttons at categories
        c_events.edit_categories();
        
        this.addEventListener('click', function(e){
        let target = e.target;
        if(target.matches('.card-down-toggle')){
            c_events.card_down_toggle(target);
        }
    });
    // Initialize the slug transformation for the category form
    this.addEventListener('keyup', function(e) {
            let target = e.target;

            if(target.matches('input[name="nombre"]')){
                c_events.transform_input_slug(target);
            }
    });
});