<?php

// Warning: This is a starting point, by no means a working module

/**
 * Redirect to parent before 404 is thrown.
 *
 */

class RedirectBeforeNotFound extends WireData implements Module, ConfigurableModule {

    /**
     * Add Hook
     *
     */
    public function init() {
        $this->addHookBefore('ProcessPageView::pageNotFound', $this, 'beforeNotFound');
    }

    public function beforeNotFound($event) {
        $uri = "$_SERVER[REQUEST_URI]";
        $regex = '#(\/[a-z0-9_\-\/]+\/)#';
        if (preg_match($regex, $uri, $matches)) {
            $request_url = $matches[1];
            $page = $this->pages->get($request_url);
            if ($page->id && $page->is(Page::statusUnpublished)) {
                if (!in_array($page->template->name, $this->redirect_templates)) return;
                if (!$this->redirect_field) return;
                $pagefield = $page->fields->get("name=" . $this->redirect_field);
                if (!$pagefield) return;
                $redirect = $page->get($this->redirect_field);
                if (!$redirect->id) return;
                $this->session->redirect($redirect->url);
            }
        }
        return;
    }
}
