<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class WordsLoaderCompilePass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if(!$container->hasDefinition('app.wordlist')) {
            return;
        }
        $wordlistServiceDefinition = $container->getDefinition('app.wordlist');

        $loaders = $container->findTaggedServiceIds('app.words_loader');
        foreach($loaders as $serviceId => $tagAttributes) {
            $wordlistServiceDefinition->addMethodCall(
                'addLoader', [new Reference($serviceId), $tagAttributes[0]['type']]
            );
        }

        // The addLoader calls have to be done before any other
        $wordlistServiceCalls = array_reverse($wordlistServiceDefinition->getMethodCalls());
        $wordlistServiceDefinition->setMethodCalls($wordlistServiceCalls);

        $container->setDefinition('app.wordlist', $wordlistServiceDefinition);
    }
}