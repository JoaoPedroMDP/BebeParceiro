#  coding: utf-8
import logging

from core.models import Child
from core.repositories import Repository

lgr = logging.getLogger(__name__)


class ChildRepository(Repository):
    model = Child
