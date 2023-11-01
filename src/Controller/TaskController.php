<?php
namespace App\Controller;

use App\Form\TaskType;
use App\Service\TaskService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Entity\Task;
use App\Repository\CategoryRepository;
use App\Repository\TaskRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface as PagerPaginatorInterface;
use Knp\Component\Paginator\PaginatorInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('IS_AUTHENTICATED_FULLY')]
#[Route('/task', name: 'app_task')]
class TaskController extends AbstractController
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request): Response
    {
        $form = $this->createForm(TaskType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $this->taskService->createTask($task);
            return $this->redirectToRoute('app_taskcreate');
        }

        return $this->render('task/update.html.twig', [
            'task_form' => $form->createView(),
        ]);
    }

    #[Route('/list', name: 'list')]
    public function list( TaskRepository $taskRepository): Response
    {
        $task = $this->taskService->getTaskList();

        return $this->render('task/list.html.twig', [
            'tasks' => $task,
        ]);
    }

    #[Route('/view/{id}', name: 'view')]
    public function view(int $id): Response
    {
        $task = $this->taskService->getTaskById($id);

        return $this->render('task/view.html.twig', [
            'task' => $task,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(int $id): Response
    {
        $task = $this->taskService->getTaskById($id);
    
        if (!$task) {
            throw $this->createNotFoundException('Задача не найдена');
        }
    
        $this->taskService->deleteTask($task);
    
        return $this->redirectToRoute('app_tasklist');
    }
    

    #[Route('/update/{id}', name: 'update')]
    public function update(int $id, Request $request): Response
    {
        $task = $this->taskService->getTaskById($id);
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->taskService->updateTask($task);
            return $this->redirectToRoute('app_task_view', ['id' => $task->getId()]);
        }

        return $this->render('task/update.html.twig', [
            'task' => $task,
            'task_form' => $form->createView(),
        ]);
    }
}
