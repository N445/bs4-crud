<?= "<?php\n" ?>

namespace <?= $namespace ?>;

use <?= $entity_full_class_name ?>;
use <?= $form_full_class_name ?>;
<?php if (isset($repository_full_class_name)): ?>
use <?= $repository_full_class_name ?>;
<?php endif ?>
use Symfony\Bundle\FrameworkBundle\Controller\<?= $parent_class_name ?>;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("<?= $route_path ?>")
 */
class <?= $class_name ?> extends <?= $parent_class_name; ?><?= "\n" ?>
{
    const CURRENT_GROUP = '<?php echo strtoupper($entity_class_name . '_group'); ?>';

    /**
     * SkillController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/", name="<?= strtoupper($route_name) ?>_INDEX", methods={"GET"})
<?php if (isset($repository_full_class_name)): ?>
     * @param <?= $repository_class_name ?> $<?= $repository_var ?><?= "\n" ?>
<?php endif ?>
     * @return Response
     */
<?php if (isset($repository_full_class_name)): ?>
    public function index(<?= $repository_class_name ?> $<?= $repository_var ?>): Response
    {
        return $this->render(
            '<?= $templates_path ?>/index.html.twig',
            [
                '<?= $entity_twig_var_plural ?>' => $<?= $repository_var ?>->findAll(),
                'current_group' => self::CURRENT_GROUP
            ]
        );
    }
<?php else: ?>
    public function index(): Response
    {
        $<?= $entity_var_plural ?> = $this->getDoctrine()->getRepository(<?= $entity_class_name ?>::class)->findAll();
        return $this->render(
            '<?= $templates_path ?>/index.html.twig',
            [
                '<?= $entity_twig_var_plural ?>' => $<?= $entity_var_plural ?>,
                'current_group' => self::CURRENT_GROUP
            ]
        );
    }
<?php endif ?>

    /**
     * @Route("/new", name="<?=strtoupper($route_name)?>_NEW", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $<?= $entity_var_singular ?> = new <?= $entity_class_name ?>();
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($<?= $entity_var_singular ?>);
            $this->em->flush();

            return $this->redirectToRoute('<?=strtoupper($route_name)?>_INDEX');
        }

        return $this->render(
            '<?= $templates_path ?>/new.html.twig',
            [
                '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
                'form' => $form->createView(),
                'current_group' => self::CURRENT_GROUP
            ]
        );
    }

    /**
     * @Route("/{<?= $entity_identifier ?>}", name="<?=strtoupper($route_name)?>_SHOW", methods={"GET"})
     * @return Response
     */
    public function show(<?= $entity_class_name ?> $<?= $entity_var_singular ?>): Response
    {
        return $this->render(
            '<?= $templates_path ?>/show.html.twig',
            [
                '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
                'current_group' => self::CURRENT_GROUP
            ]
        );
    }

    /**
     * @Route("/{<?= $entity_identifier ?>}/edit", name="<?=strtoupper($route_name)?>_EDIT", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>): Response
    {
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('<?=strtoupper($route_name)?>_INDEX', ['<?= $entity_identifier ?>' => $<?= $entity_var_singular ?>->get<?= ucfirst($entity_identifier) ?>()]);
        }

        return $this->render(
            '<?= $templates_path ?>/edit.html.twig',
            [
                '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
                'form' => $form->createView(),
                'current_group' => self::CURRENT_GROUP
            ]
        );
    }

    /**
     * @Route("/{<?= $entity_identifier ?>}", name="<?=strtoupper($route_name)?>_DELETE", methods={"DELETE"})
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>): Response
    {
        if ($this->isCsrfTokenValid('delete'.$<?= $entity_var_singular ?>->get<?= ucfirst($entity_identifier) ?>(), $request->request->get('_token'))) {
            $this->em->remove($<?= $entity_var_singular ?>);
            $this->em->flush();
        }

        return $this->redirectToRoute('<?=strtoupper($route_name)?>_INDEX');
    }

    /**
     * @Route("/{id}/switch-value", name="<?=strtoupper($route_name)?>_SWITCH_UPDATE", methods={"POST"}, options={"expose":true})
     * @param Request $request
     * @param <?= $entity_class_name ?> $<?= $entity_var_singular ?>
     * @return Response
     */
    public function switchUpdate(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>): Response
    {
        $method = 'set' . ucfirst($request->get('fieldname'));
        $value  = filter_var($request->get('value'), FILTER_VALIDATE_BOOLEAN);
        $<?= $entity_var_singular ?>->$method($value);
        $this->em->flush();

        return new JsonResponse([
            'status' => true,
        ]);
    }
}
