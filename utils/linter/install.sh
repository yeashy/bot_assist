#!/bin/bash

CUR_DIR=$(pwd)

if ! test -f ${CUR_DIR}/utils/linter/install.sh; then
    echo "ERROR - You should start install script from root directory of the project"
    exit 1
fi

chmod u+x ./vendor/bin/duster
chmod u+x ./vendor/bin/phpstan

LINTER_DIR=${CUR_DIR}/utils/linter
HOOKS_DIR=${LINTER_DIR}/hooks
GIT_HOOKS_DIR=${CUR_DIR}/.git/hooks

git config --unset core.hooksPath

cp ${HOOKS_DIR}/pre-commit ${GIT_HOOKS_DIR}/pre-commit
chmod u+x ${GIT_HOOKS_DIR}/pre-commit

cp ${HOOKS_DIR}/pre-push ${GIT_HOOKS_DIR}/pre-push
chmod u+x ${GIT_HOOKS_DIR}/pre-push

chmod u+x ${LINTER_DIR}/lint.sh
