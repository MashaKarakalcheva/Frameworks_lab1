<?php 

namespace App\Tests\Service;

use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Service\TaskService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class TaskServiceTest extends TestCase
{
    public function testCreateTask()
    {
        $task = new Task();
        
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $taskRepository = $this->createMock(TaskRepository::class);
        
        $taskService = new TaskService($entityManager, $taskRepository);
        $result = $taskService->createTask($task);
        
        $this->assertSame($task, $result);
    }

    

    public function testGetTaskList()
    {
        $tasks = [new Task(), new Task()];
        
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $taskRepository = $this->createMock(TaskRepository::class);
        $taskRepository->expects($this->once())->method('findAll')->willReturn($tasks);
        
        $taskService = new TaskService($entityManager, $taskRepository);
        $result = $taskService->getTaskList();
        
        $this->assertSame($tasks, $result);
    }

    public function testGetTaskById()
    {
        $task = new Task();
        $taskId = 1;
        
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $taskRepository = $this->createMock(TaskRepository::class);
        $taskRepository->expects($this->once())->method('find')->with($taskId)->willReturn($task);
        
        $taskService = new TaskService($entityManager, $taskRepository);
        $result = $taskService->getTaskById($taskId);
        
        $this->assertSame($task, $result);
    }
}
