<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;
use application\lib\TreeBuilder;
use application\services\SectionService;

class SectionsController extends Controller
{
    /**
     * Show main page.
     *
     * @return void
     */
    public function index (): void
    {
        $sectionsList = $this->model->getAllSections();
        $tree         = new TreeBuilder();
        $data = $tree->buildTree($sectionsList);

        $data = [
            'sections' => $sectionsList,
            'tree'     => $tree->renderTree($data)
        ];

        $this->view->render('List of sections', $data);
    }

    /**
     * Save data.
     *
     * @return void
     */
    public function store (): void
    {
        if (isset($_POST)) {
            $section = new SectionService();

            if ($section->createSection($_POST, new Db())) {
                redirect('/')->go();
            }

            redirect()->back()->withErrors($section->message)->go();
        }
    }

    /**
     * Rendering create sections form.
     *
     * @return void
     */
    public function form (): void
    {
        $data = [
            'sections' => $this->model->getAllSections()
        ];

        $this->view->render('Create sections', $data);
    }

    /**
     * Show specific section details by id.
     *
     * @return void
     */
    public function show (): void
    {
        $sectionId = $this->request->id;

        $section = $this->model->getSectionInformation($sectionId);

        if (empty($section)) {
            redirect('/')->go();
        }

        $data = [
            'sectionInfo' => $section
        ];

        $this->view->render('Section - '. $sectionId, $data);
    }

    /**
     * Show edit form section.
     *
     * @return void
     */
    public function edit ()
    {
        $section = $this->model->getSectionById($this->request->id);

        if (empty($section)) {
            redirect('/')->go();
        }

        $data = [
            'section'  => $section,
            'sections' => $this->model->getAllSections()
        ];

        $this->view->render('Edit section - '. $section['name'], $data);
    }

    /**
     * Updating data about section.
     *
     * @return void
     */
    public function update (): void
    {
        if (isset($_POST)) {
            $section = new SectionService();

            if ($section->updateSection($this->request->id, $_POST, new Db())) {
                redirect()->back()->go();
            }

            redirect()->back()->withErrors($section->message)->go();
        }
    }

    /**
     * Deleting section.
     *
     * @return void
     */
    public function destroy (): void
    {
        if (isset($_GET)) {
            $section = new SectionService();

            if($section->deleteSection($this->request->id, new Db())) {
                redirect('/')->go();
            }

            redirect()->back()->withErrors($section->message)->go();
        }
    }
}
